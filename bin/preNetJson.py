##########################################################
###                  preNetJson.py                    ###
##########################################################
# This python script is to convert network edge csv file to
# json format to prepare for echarts plotting.

import pandas as pd
import sys
import json
import pprint


###################  define network class  ######################
class echartsNetJson(object):
    def __init__(self):
        self.type = 'force'
        self.categories = [{"name": "gene",
                            "keyword": {},
                            "base": "gene"}]
        self.nodes = []
        self.links = []
        self.data = {'type': self.type,
                     'categories': self.categories,
                     'nodes': self.nodes,
                     'links': self.links}

    def addCatHub(self):
        self.categories.append({"name": "hub gene",
                                "keyword": {},
                                "base": "hub gene"})

    def addNode(self, name, category):
        if len(self.nodes) == 0:
            self.nodes.append({"name": name,
                               "value": 1,
                               "category": category})
        else:
            for node in self.nodes:
                if node["name"] == name:
                    print('Node {} already exist.'.format(name))
                    return
            else:
                self.nodes.append({"name": name,
                                   "value": 1,
                                   "category": category})

    def addLink(self, node1, node2):
        idx1 = self.findNodeIndex(nodeName=node1)
        idx2 = self.findNodeIndex(nodeName=node2)
        if idx1 is not None and idx2 is not None:
            if idx1 > idx2:
                (idx1, idx2) = (idx2, idx1)
            for link in self.links:
                if link["source"] == idx1 and link["target"] == idx2:
                    print('Link {} to {} already exist.'.format(node1, node2))
                    return
            self.links.append({"source": idx1,
                               "target": idx2})

    def findNodeIndex(self, nodeName):
        idx = 0
        for node in self.nodes:
            if node["name"] == nodeName:
                return idx
            else:
                idx += 1
        print('Did not find {}.'.format(nodeName))
        return None


###########################  read data  ############################
### parse input
edge_path = sys.argv[1]
hub_genes = None
if len(sys.argv) > 2:
    hub_genes = sys.argv[2]

### prepare output
json_path = edge_path.strip('.csv') + '.json'

### initiate networkjson
netjson = echartsNetJson()
edges = pd.read_csv(edge_path)

if hub_genes is not None:
    hub_genes = hub_genes.split(',')
    netjson.addCatHub()


##################  nodes  ######################
nodes = set(edges.iloc[:,0])
nodes = nodes | set(edges.iloc[:,1])

for node in nodes:
    if hub_genes is not None and node in hub_genes:
        netjson.addNode(name=node, category=1)
    else:
        netjson.addNode(name=node, category=0)

##################  edges  ######################
links = [tuple(link) for link in edges.values]
for link in links:
    netjson.addLink(node1=link[0], node2=link[1])

##################  write json output  ####################
json_file = open(json_path, "w")
json_file.write(json.dumps(netjson.data))
json_file.close()
