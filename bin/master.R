###                    master.R                     ###
### =============================================== ###
# This R script is a pipline to construct gene network

suppressMessages(library(argparse))

#############  1. Parse comandline argument  #################
parser <- ArgumentParser(description = "This pipline is to construct gene network using gene co-expression data and specified hub gene information.")
parser$add_argument("jobID", type = "character", help = "jobID which will be used to find .")
parser$add_argument("method", type = "integer", help = "method to use to construct the gene network, should be integer [1,9].")
parser$add_argument("param", type = "double", help = "parameter for method")
parser$add_argument("-b", "--hub", type = "character", help = "list of hub genes separated by comma, [gene1,gene2,...], only necessary when method is 8 or 9.")
parser$add_argument("-p", "--param_2", type = "double", help = "additional parameter if the method is 8 or 9.")

args <- parser$parse_args()
jobID <- args$jobID
method <- args$method
param <- args$param
hub <- args$hub
param_2 <- args$param_2

### concat input expression data
expr.file <- paste("../data/expr.", jobID, ".csv", sep = "")

### concat output edge data
est_edge.csv <- paste("../data/est_edge.", jobID, ".csv", sep = "")

### concat temp message file
tmp.message.file <- paste("../data/tmp_message.", jobID, ".txt", sep = "")

#############  2. Read data  #################
### suppress printing message to tmp file
log.f <- file(tmp.message.file, open = "wt")
sink(file = log.f)

### check methods
if (!(method %in% 1:9)) {
    stop('Parse method error, method should be in integer 1 to 9.')
}

### read input data
expr.data <- read.csv(file = expr.file, header = TRUE)

### parse hub gene
if (!is.null(hub)) {
    gene.index <- colnames(expr.data)
    hub.v <- strsplit(hub, ",")[[1]]
    hub.index <- sapply(1:length(hub.v), FUN = function(x) which(hub.v[x] == gene.index))
}


#############  3. Parse methods & construct network #################
if (method == 1) {
    source("GeneNet.R")
    est_edge <- network.GeneNet(expr.data = expr.data, fdr = param)
} else if (method == 2) {
    source("ns.R")
    est_edge <- network.ns(expr.data = expr.data, alpha = param)
} else if (method == 3) {
    source("glasso.R")
    est_edge <- network.glasso(expr.data = expr.data, lambda = param)
} else if (method == 4) {
    source("glassosf.R")
    est_edge <- network.glassosf(expr.data = expr.data, alpha = param)
} else if (method == 5) {
    source("pcacmi.R")
    est_edge <- network.pcacmi(expr.data = expr.data, lambda = param)
} else if (method == 6) {
    source("cmi2ni.R")
    est_edge <- network.cmi2ni(expr.data = expr.data, lambda = param)
} else if (method == 7) {
    source("space.R")
    est_edge <- network.space(expr.data = expr.data, alpha = param)
} else if (method == 8) {
    source("eglasso.R")
    est_edge <- network.eglasso(expr.data = expr.data, hub.index = hub.index, alpha = param, lambda = param_2)
} else if (method == 9) {
    source("espace.R")
    est_edge <- network.espace(expr.data = expr.data, hub.index = hub.index, alpha = param, lambda = param_2)
}

#############  4. Write output  #################
write.csv(est_edge, file = est_edge.csv, row.names = FALSE)

### close tmp file
sink()
close(log.f)