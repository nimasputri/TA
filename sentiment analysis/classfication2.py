import nltk
from helper import Helper

tweet = 'tono asik'

helper = Helper()
# helper.setFilteredTweet('opinion.dat')
# training_set = nltk.classify.apply_features(helper.extract_features, helper.filtered_tweet)
# print helper.positive_value
# print helper.negative_value
# classifier = nltk.NaiveBayesClassifier.train(training_set)
# helper.setFilteredTweet('sentiment.dat')
# training_set = nltk.classify.apply_features(helper.extract_features, helper.filtered_tweet)
# classifier2 = nltk.NaiveBayesClassifier.train(training_set)
# helper.save_model('opinion-naivebayes.mdl', classifier)
classifier = helper.load_model('opinion-naivebayes.mdl')
classifier2 = helper.load_model('sentiment-naivebayes.mdl')
# helper.setFilteredTweet('tweets.dat')
classic = helper.extract_features(tweet.split())
corpus_tag = helper.get_tag_from_corpus()
corpus_text = helper.get_text_from_corpus()
test_tag = []
for text in corpus_text:
    result = classifier.classify(helper.extract_features_opinion(text.split()))
    if result == '1':
        result = classifier2.classify(helper.extract_features(text.split()))
    test_tag.append(result)
corpus_tag.reverse()
print corpus_tag
test_tag.reverse()
print test_tag
# print corpus_tag
# print test_tag
cm = nltk.ConfusionMatrix(corpus_tag, test_tag)
print cm.pp(sort_by_count=True, show_percents=True, truncate=9)
print classic
print classifier.classify(classic)
