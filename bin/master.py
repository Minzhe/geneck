#####################################################
###                  master.py                    ###
#####################################################

import pymysql
import os
import sys
import re


###############      function      #################
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

def parseMethod(method):
    '''
    Parse integer method code to real methods.
    :param method: integer
    :return: method name
    '''
    if method == 1:
        return 'GeneNet'
    elif method == 2:
        return 'ns'
    elif method == 3:
        return 'glasso'
    elif method == 4:
        return 'glassosf'
    elif method == 5:
        return 'pcacmi'
    elif method == 6:
        return 'cmi2ni'
    elif method == 7:
        return 'space'
    elif method == 8:
        return 'eglasso'
    elif method == 9:
        return 'espace'
    else:
        return NameError('Cannot parse method type.\n')


###############      main      ###################
### parse database configuration
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
      'FROM `Jobs` WHERE Status = 0 ORDER by CreateTime DESC LIMIT 1'
cursor.execute(sql)
entry = cursor.fetchone()

### if no new job, stop this script
if entry is None:
    sys.exit('No new job found in database.\n')

### assign job content
job = dict()
job['JobID'] = entry[0]
job['UserName'] = entry[1]
job['Email'] = entry[2]
job['GeneExpression'] = entry[3]
job['HubGenes'] = entry[4]
job['Method'] = parseMethod(entry[5])
job['Param'] = entry[6]
job['Param_2'] = entry[7]


### update job status
sql = 'UPDATE Jobs SET Status = 1 WHERE JobID = \'{}\''.format(job['JobID'])
cursor.execute(sql)
conn.commit()

### start job
print('*** Running new job {} using methods {}.'.format(job['JobID'], job['Method']))

# write gene expression data
tmp_geneExpression = os.path.realpath(os.path.join(cur_dir, '..', 'data', 'expr.{}.csv'.format(job['JobID'])))
try:
    with open(tmp_geneExpression, 'w') as f:
        print(job['GeneExpression'], file=f)
except:
    raise IOError('Cannot write gene expression data {}.'.format(job['JobID']))

# run job based on their specified method
if job['Method'] in ['GeneNet', 'ns', 'glasso', 'pcacmi', 'cmi2ni', 'space']:
    cmd = 'Rscript {}.R {} {}'.format(job['Method'], tmp_geneExpression, job['Param'])
elif job['Method'] in ['eglasso', 'espace']:
    cmd = 'Rscript {}.R {} {} {} {}'.format(job['Method'], tmp_geneExpression, job['HubGenes'], job['Param'], job['Param_2'])
try:
    print(cmd)
except:
    raise SystemError('Cannot run command ${}'.format(cmd))

### check output result (!!!!!!!! need to use multiprocess to monitoring Rscript output !!!!!!!!!!)
tmp_result_csv = os.path.realpath(os.path.join(cur_dir, '..', 'data', 'result.{}.csv'.format(job['JobID'])))
tmp_result_json = os.path.realpath(os.path.join(cur_dir, '..', 'data', 'result.{}.json'.format(job['JobID'])))
# no result, stop the script
if not os.path.exists(tmp_result_csv):
    sql = 'UPDATE Jobs SET Status = 3, FinishTime = now() WHERE JobID = \'{}\''.format(job['JobID'])
    cursor.execute(sql)
    conn.commit()
    conn.close()
    sys.exit('Command running time exceed time limit ${}'.format(cmd))
# insert result into database
elif os.path.exists(tmp_result_csv):
    with open(tmp_result_csv) as i_f:
        network_csv = i_f.read()
    with open(tmp_result_json) as i_f:
        network_json = i_f.read()


