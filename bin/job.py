#####################################################
###                   job.py                      ###
#####################################################
#!/opt/anaconda3/bin/python

import sys
import pymysql
import os
import re
import subprocess


### ==================      function      =================== ###
def parseDBconfig(config_file):
    '''
    Read database configuration information
    :param config_file: configuration file path
    :return: list of host, user, password, db information
    '''
    if os.path.exists(config_file):
        db_config_dict = dict()
        with open(config_file) as f:
            line = f.readline().strip()
            while line:
                if '$hostname' in line:
                    db_config_dict['hostname'] = re.search('".*"', line).group(0).strip('"')
                elif '$usr' in line:
                    db_config_dict['usr'] = re.search('".*"', line).group(0).strip('"')
                elif '$pwd' in line:
                    db_config_dict['pwd'] = re.search('".*"', line).group(0).strip('"')
                elif '$dbname' in line:
                    db_config_dict['dbname'] = re.search('".*"', line).group(0).strip('"')
                line = f.readline().strip()
    else:
        raise IOError('Database configuration file does not exist.\n', sys.exc_info())
    return db_config_dict

def readFileContent(file):
    '''
    Read file content
    :param file: file path
    :return: string content
    '''
    with open(file) as f:
        content = f.read()
    return content

def executeSQL(connection, cursor, sql, value=None):
    '''
    Execute sql command
    :param connection: pymysql connection
    :param cursor: pymysql cursor
    :param sql: sql command
    :return: none
    '''
    try:
        if value is None:
            cursor.execute(sql)
        else:
            cursor.execute(sql, value)
        connection.commit()
    except:
        sys.exit('MySQL error: {}'.format(sql))

def cleanExit():
    os.remove(tmp_geneExpression)
    os.remove(tmp_result_csv)
    os.remove(tmp_result_json)
    os.remove(tmp_message)
    sys.exit()


### ===================      main      ===================== ###
verbose = False
if len(sys.argv) > 1 and sys.argv[1] == 'verbose':
    verbose = True

### -----------   database config   ---------------- ###
cur_dir = os.path.dirname(os.path.abspath(__file__))
db_config_path = os.path.realpath(os.path.join(cur_dir, '..', '..', '..', 'dbincloc', 'geneck.inc'))
db_config_dict = parseDBconfig(config_file=db_config_path)
### connect to database
conn = pymysql.connect(host=db_config_dict['hostname'],
                       user=db_config_dict['usr'],
                       passwd=db_config_dict['pwd'],
                       db=db_config_dict['dbname'],
                       charset='utf8')
cursor = conn.cursor()
### retrieve the lasted unprocessed job
sql = 'SELECT JobID, UserName, Email, GeneExpression, HubGenes, Method, Param, Param_2 ' \
      'FROM `Jobs` WHERE Status = 0 ORDER by CreateTime LIMIT 1'
cursor.execute(sql)
entry = cursor.fetchone()
### if no new job, stop this script
if entry is None:
    if verbose:
        sys.exit('No new job found in database.\n')
    sys.exit()

### --------------------  assign job content  ---------------------- ###
job = dict()
job['JobID'] = entry[0]
job['UserName'] = entry[1]
job['Email'] = entry[2]
job['GeneExpression'] = entry[3]
job['HubGenes'] = entry[4]
job['Method'] = entry[5]
job['Param'] = entry[6]
job['Param_2'] = entry[7]
### update job status
sql = 'UPDATE Jobs SET Status = 1 WHERE JobID = \'{}\''.format(job['JobID'])
executeSQL(connection=conn, cursor=cursor, sql=sql)

### ----------------------  start job  --------------------------- ###
if verbose:
    print('*** Running new job {} using methods {}.'.format(job['JobID'], job['Method']))
# write gene expression data
tmp_geneExpression = os.path.realpath(os.path.join(cur_dir, '..', 'data', 'expr.{}.csv'.format(job['JobID'])))
try:
    expr_csv = open(tmp_geneExpression, 'wb')
    expr_csv.write(job['GeneExpression'])
    expr_csv.close()
except:
    print('Cannot write gene expression data {}.'.format(job['JobID']))
    cleanExit()
# run job based on their specified method
if job['Method'] in [1, 2, 3, 4, 5, 6, 7, 10]:
    cmd = ['Rscript', 'master.R', job['JobID'], str(job['Method']), str(job['Param'])]
elif job['Method'] in [8, 9]:
    cmd = ['Rscript', 'master.R', job['JobID'], str(job['Method']), str(job['Param']), '-b', job['HubGenes'], '-p', str(job['Param_2'])]
if verbose:
    print(' '.join(cmd))
try:
    subprocess.run(cmd)
except:
    print('Cannot run command ${}'.format(' '.join(cmd)))
    cleanExit()

### -------------------  monitor job  --------------------------- ###
### check output result (!!!!!!!! need to use multiprocess to monitoring Rscript output !!!!!!!!!!)
tmp_result_csv = os.path.realpath(os.path.join(cur_dir, '..', 'data', 'est_edge.{}.csv'.format(job['JobID'])))
tmp_result_json = os.path.realpath(os.path.join(cur_dir, '..', 'data', 'est_edge.{}.json'.format(job['JobID'])))
tmp_message = os.path.realpath(os.path.join(cur_dir, '..', 'data', 'tmp_message.{}.txt'.format(job['JobID'])))
# no result, stop the script
if not os.path.exists(tmp_result_csv):
    sql = 'UPDATE Jobs SET Status = 3, FinishTime = now() WHERE JobID = \'{}\''.format(job['JobID'])
    cursor.execute(sql)
    conn.commit()
    conn.close()
    print('Command running time exceed time limit ${}'.format(' '.join(cmd)))
    cleanExit()
# write json output for network visualization
else:
    if job['Method'] in [1, 2, 3, 4, 5, 6, 7, 10]:
        cmd = ['python', 'preNetJson.py', tmp_result_csv]
    elif job['Method'] in [8, 9]:
        cmd = ['python', 'preNetJson.py', tmp_result_csv, job['HubGenes']]
    try:
        subprocess.run(cmd)
    except:
        print('Cannot run command ${}'.format(' '.join(cmd)))
        cleanExit()

### ---------------------  store result  ------------------------- ###
if os.path.exists(tmp_result_csv) and os.path.exists(tmp_result_json):
    # read csv and json content
    est_edge_csv = readFileContent(tmp_result_csv)
    est_edge_json = readFileContent(tmp_result_json)
    # insert into mysql
    sql = 'INSERT INTO Results (JobID, EstEdge_csv, EstEdge_json) VALUES (%s, %s, %s)'
    executeSQL(connection=conn, cursor=cursor, sql=sql, value=(job['JobID'], est_edge_csv, est_edge_json))
    # update job status to be fininshed
    sql = 'UPDATE Jobs SET Status = 2, FinishTime = now() WHERE JobID = \'{}\''.format(job['JobID'])
    executeSQL(connection=conn, cursor=cursor, sql=sql)

### ----------------  remove local temp file  --------------------- ###
cleanExit()
