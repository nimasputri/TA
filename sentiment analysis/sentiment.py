import nltk
from helper import Helper

tweet = 'tono gendut jelek'
# print classifier.classify(extract_features(tweet.split()))


helper = Helper()
helper.setFilteredTweet('sentiment.dat')
training_set = nltk.classify.apply_features(helper.extract_features, helper.filtered_tweet)
# print helper.positive_value
# print helper.negative_value
# classifier = SvmClassifier.train(training_set)
classifier = nltk.NaiveBayesClassifier.train(training_set)
helper.save_model('sentiment-naivebayes.mdl', classifier)
# helper.save_model('sentiment-svm.mdl', classifier)
# classifier = helper.load_model('sentiment-naivebayes.mdl')
classic = helper.extract_features(tweet.split())
corpus_tag = helper.get_tag_from_corpus('sentiment.dat')
corpus_text = helper.get_text_from_corpus('sentiment.dat')
test_tag = []
for text in corpus_text:
    result = classifier.classify(helper.extract_features(text.split()))
    test_tag.append(result)
corpus_tag.reverse()
test_tag.reverse()
cm = nltk.ConfusionMatrix(corpus_tag, test_tag)
print cm.pp(sort_by_count=True, show_percents=True, truncate=9)
print classic
print classifier.classify(classic)
