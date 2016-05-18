import nltk
from svmutil import *
from helper import Helper

helper = Helper()
# print helper.filtered_tweet
training_set = nltk.classify.apply_features(helper.extract_features, helper.filtered_tweet)
# print training_set

svm_feature = helper.svm_apply_feature()

for tweet in svm_feature[1][:5]:
    print tweet

prob = svm_problem(svm_feature[1], svm_feature[0])
param = svm_parameter()
param.svm_type = 0
param.kernel_type = 2
param.C = 10
model = svm_train(prob, param)
svm_predict(svm_feature[1], svm_feature[0], model)
