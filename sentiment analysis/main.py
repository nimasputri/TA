import nltk
from helper import Helper
# from translate import Translator
# import unicodedata
# import dataparser


tweet = 'kasih hahaha'
# print classifier.classify(extract_features(tweet.split()))

#inisiasi awal
helper = Helper()

#ini buat inisiasi data latih
#helper.extract_features buat ngitung jumlah kata yang masuk ke positif/negatif/dll
#helper.filtered_tweet buat data latih (jadi dipisah tweet, sama targetnya yang dari tweet.dat)
training_set = nltk.classify.apply_features(helper.extract_features, helper.filtered_tweet)

#ini buat mulai ngetrain (ngehasilin model)
classifier = nltk.NaiveBayesClassifier.train(training_set)
# classifier = nltk.MaxentClassifier.train(training_set)
# helper.save_model('maxent.mdl', classifier)

#ini mah cuma ngeprint yang didalem file question.txt
print helper.question_text

# classifier = helper.load_model('naivebayes.mdl')
# classifier2 = helper.load_model('sentiment-maxent.mdl')

#mecah kalimat jadi kata2
print helper.replace_two_or_more_liat(tweet.split())

#corpus = data uji
corpus_tag = helper.get_tag_from_corpus("tweets.dat")
corpus_text = helper.get_text_from_corpus("tweets.dat")
test_tag = []
#untuk nguji
corpus_text = ["Aku ga suka sama kamu"]
for text in corpus_text:
	#untuk klasifikasi si "text" di corpus
    result = classifier.classify(helper.extract_features(text.split()))
    print result
    # if result == '1':
    #     result = classifier2.classify(helper.extract_features(text.split()))
    test_tag.append(result)
corpus_tag.reverse()
test_tag.reverse()
# print corpus_tag
# print test_tag

#untuk ngebandingin harusnya apa (corpus_tag) sama hasilnya apa (test_tag)
cm = nltk.ConfusionMatrix(corpus_tag, test_tag)
print cm

#ini buat coba-coba ngeklasifikasi ke model (modelnya ada di variable classifier)
classic = helper.extract_features(helper.replace_two_or_more_liat(["ga", "amazing"]))
print classic
print classifier.classify(classic)

# print helper.get_tag_from_corpus()
# print helper.get_text_from_corpus()
# parser = dataparser.DataParser()
# parser.getTweetDataByPage(page=100, skip=0, next=1347289619)

# helper = Helper()
# translator = Translator()
# # helper.convert_sentiwordnet('sentiwordnet.txt', 'result.txt')
# # print helper.count_words("result.txt")
# data = helper.get_array_from_file("result.txt")
# positive_value = helper.get_positive_array_from_file("result.txt")
# negative_value = helper.get_negative_array_from_file("result.txt")

# berkas = open('indonesia.txt', 'w+')
# # count = 0
# for i in range(38057, len(data)):
#     retval = translator.translate_one_word(data[i])
#     print i
#     retval = unicodedata.normalize('NFKD', retval).encode('ascii', 'ignore')
#     berkas.write(retval)
#     berkas.write(' ')
#     berkas.write(positive_value[i])
#     berkas.write(' ')
#     berkas.write(negative_value[i])
#     berkas.write('\n')
    # count += 1
    # if count > 5:
    #     break


# 450 1354176578
# 550 1352709827
# 650 1351260810
# 750 1350216870
# 850 1349539954
# 950 1348557601
# 1050 1347289619

# 50 0
# 100 50
# 100 150
# 100 250
# 100 350 1354176578
# 100 450 1352709827
# 100 0 1352709827
