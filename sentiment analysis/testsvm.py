from svmutil import *

x = [[1, 0, 1], [-1, 0, -1], [-1, 0, -1], [9, 10, 222]]
# x has the data
y = [1, 1, -1, 1]
# y has the corresponding class labels of each item in x
prob = svm_problem(y, x)
param = svm_parameter()
param.kernel_type = LINEAR
param.C = 10
m = svm_train(prob, param)
print svm_predict(y, x, m)
print svm_predict([0], [[0, 0, 0]], m)
