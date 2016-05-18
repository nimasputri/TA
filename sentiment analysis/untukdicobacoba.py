import nltk, sys
from helper import Helper

import mysql.connector

cnx = mysql.connector.connect(user='root', password='',
                              host='127.0.0.1',
                              database='hrselection')
cursor = cnx.cursor()

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

#corpus = data uji
#corpus_text = helper.get_text_from_corpus_v2("aaaa.dat")

netral = negatif = positif = 0

persen_hasil = {
    'negatif': 0,
    'netral': 0,
    'positif': 0
}

#minta id sama username
args = sys.argv
idorang = args[1]
username = args[2]

#masukin text yang mau diuji ke file testfile.dat
corpus_text = helper.get_text_from_corpus_v2("tweets/" + username + ".dat")

for text in corpus_text:
    result = classifier.classify(helper.extract_features(text.split()))
    
    #####
    if result == '0':
    	netral += 1
    elif result == '1':
    	negatif += 1
    else:
    	positif += 1

cursor.execute ("UPDATE kandidat SET jumlah_sentimen_net=%d, jumlah_sentimen_neg=%d, jumlah_sentimen_pos=%d WHERE id_kandidat='%s'" % (netral, negatif, positif, idorang))
# to load to database
cnx.commit()

query = ("SELECT jumlah_sentimen_net, jumlah_sentimen_neg, jumlah_sentimen_pos FROM kandidat WHERE id_kandidat = " + idorang)

cursor.execute(query)

for (jumlah_sentimen_net, jumlah_sentimen_neg, jumlah_sentimen_pos) in cursor:
    print("{}, {}, {}".format(jumlah_sentimen_net, jumlah_sentimen_neg, jumlah_sentimen_pos))
   
cursor.close()
cnx.close()