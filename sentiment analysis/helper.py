from nltk import FreqDist
import re
import pickle


class Helper:
    TWEET_FILE = "tweets.dat"
    POSITIVE_TEXT = "positive.txt"
    NEGATIVE_TEXT = "negative.txt"
    NEGATION_TEXT = "negation.txt"
    QUESTION_TEXT = "question.txt"

    def __init__(self):
        """
        Constructor for filtered tweet initialization
        """
        self.filtered_tweet = self.filter_tweets(self.parse_file_tweets())
        self.word_features = self.get_word_features(self.get_words_in_tweets(self.filtered_tweet))
        self.positive_text = self.parse_file_sentiment_to_array(self.POSITIVE_TEXT)
        self.positive_value = self.parse_positive_value(self.POSITIVE_TEXT)
        self.negative_text = self.parse_file_sentiment_to_array(self.NEGATIVE_TEXT)
        self.negative_value = self.parse_negative_value(self.NEGATIVE_TEXT)
        self.negation_text = self.parse_file_to_array(self.NEGATION_TEXT)
        self.question_text = self.parse_file_to_array(self.QUESTION_TEXT)

    def replace_two_or_more(self, s):
        #look for 2 or more repetitions of character and replace with the character itself
        pattern = re.compile(r"(.)\1{1,}", re.DOTALL)
        return pattern.sub(r"\1\1", s)

    def replace_two_or_more_liat(self, arr):
        retval = []
        for s in arr:
            s = self.replace_two_or_more(s)
            retval.append(s)
        return retval

    def setFilteredTweet(self, filename):
        """
        filename - the name of the tweet file
        this function set the filtered tweet in the object
        """
        self.TWEET_FILE = filename
        self.filtered_tweet = self.filter_tweets(self.parse_file_tweets(filename))
        self.word_features = self.get_word_features(self.get_words_in_tweets(self.filtered_tweet))

    def parse_positive_value(self, filename):
        """
        filename - the name of the sentiment file
        this function parse the positive value of the sentiment file
        """
        berkas = open(filename)
        lines = berkas.read().split('\n')
        retval = {}
        for line in lines:
            words = line.split()
            retval[words[0]] = float(words[1])
        return retval

    def parse_negative_value(self, filename):
        """
        filename - the name of the sentiment file
        this function parse the negative value of the sentiment file
        """
        berkas = open(filename)
        lines = berkas.read().split('\n')
        retval = {}
        for line in lines:
            words = line.split()
            retval[words[0]] = float(words[2])
        return retval

    def parse_file_sentiment_to_array(self, filename):
        berkas = open(filename)
        lines = berkas.read().split('\n')
        retval = []
        for line in lines:
            words = line.split()
            retval.append(words[0])
        return retval

    def parse_file_to_array(self, filename):
        berkas = open(filename)
        lines = berkas.read().split('\n')
        retval = []
        for line in lines:
            retval.append(line)
        return retval

    def convert_sentiwordnet(self, filename, target):
        """
        filename - SentiWordNet file path
        target - target file path
        This function convert the SentiWordNet type into the more readable format "word positive negative"
        """
        berkas = open(filename)
        hasil = open(target, 'w+')
        lines = berkas.read().split('\n')
        for line in lines:
            words = line.split()
            try:
                hasil.write(words[4][:-2])
            except IndexError:
                continue
            hasil.write(' ')
            hasil.write(words[2])
            hasil.write(' ')
            hasil.write(words[3])
            hasil.write('\n')

    def count_number_of_words(self, data=[]):
        """
        data - an array of strings
        This function count the length of the strings inside the array
        """
        count = 0
        for i in data:
            count += len(i)
        return count

    def get_array_from_file(self, filename):
        berkas = open(filename)
        data = berkas.read().split('\n')
        retval = []
        # count = 0
        for baris in data:
            retval.append(baris.split()[0])
            # count += 1
            # if count > 5:
            #     break
        return retval

    def get_positive_array_from_file(self, filename):
        berkas = open(filename)
        data = berkas.read().split('\n')
        retval = []
        # count = 0
        for baris in data:
            words = baris.split()
            retval.append(words[1])
            # count += 1
            # if count > 5:
            #     break
        return retval

    def get_negative_array_from_file(self, filename):
        berkas = open(filename)
        data = berkas.read().split('\n')
        retval = []
        # count = 0
        for baris in data:
            words = baris.split()
            retval.append(words[2])
            # count += 1
            # if count > 5:
            #     break
        return retval

    def count_words(self, filename):
        """
        filename - the name of file that want to be counted
        This function count the number of the first word each line and return the number
        """
        berkas = open(filename)
        data = berkas.read().split('\n')
        count = 0
        for baris in data:
            count += len(baris[0])
        return count

    def parse_file_tweets(self, filename=TWEET_FILE):
        """
        Parse a tweet file with format "Text,sentiment" per line
        Return list of tuple of text and sentiment
        2 for positive
        1 for negative
        0 for neutral
        """
        berkas = open(filename)
        retval = []
        lines = berkas.read().split('\n')
        for line in lines:
            if line != '':
                retval.append((line[:-2], line[-1]))
        return retval

    def filter_tweets(self, tweets):
        """
        tweets - List of tuple of tweets and it's sentiment
        return value - Filtered List of tuple of tweets and it's sentiment
        This function filter any word that has length below 3
        """
        retval = []
        for (words, sentiment) in tweets:
            words_filtered = []
            for e in words.split():
                if len(e) >= 3 and '@' not in e and 'http://' not in e:
                    e = self.replace_two_or_more(e)
                    value = e.find(',')
                    if value != -1:
                        self.kill_char(e, value)
                    value = e.find('!')
                    if value != -1:
                        self.kill_char(e, value)
                    value = e.find('.')
                    if value != -1:
                        self.kill_char(e, value)
                    words_filtered.append(e.lower())
            retval.append((words_filtered, sentiment))
        return retval

    def get_words_in_tweets(self, tweets):
        """
        tweets - List of tuple of text and sentiment
        This function takes all the text and return it in a list of words
        """
        all_words = []
        for (words, sentiment) in tweets:
            all_words.extend(words)
        return all_words

    def get_word_features(self, wordlist):
        """
        wordlist - List of words. Word can be the same
        This function takes distinct words in list and return it in a list
        """
        wordlist = FreqDist(wordlist)
        word_features = wordlist.keys()
        return word_features

    def extract_features(self, document):
        """
        Extract the unigram feature from the token
        """
        # document_words = set(document)
        features = {}
        features['positive'] = 0
        features['negative'] = 0
        features['question'] = 0
        positive = 0.0
        negative = 0.0
        negation = False
        for idx, word in enumerate(document):
            # features['contains(%s)' % word] = (word in document_words)
            for kata in self.positive_text:
                if kata in word:
                    if negation:
                        negative += self.positive_value[kata]
                        negation = False
                    else:
                        positive += self.positive_value[kata]
            for kata in self.negative_text:
                if kata in word:
                    if negation:
                        positive += self.negative_value[kata]
                        negation = False
                    else:
                        negative += self.negative_value[kata]
            if any(word == s for s in self.negation_text):
                negation = True
            if any(s in word for s in self.question_text):
                features['question'] += 1
        features['positive'] = positive
        features['negative'] = negative
        return features

    def extract_features_opinion(self, document):
        """
        Extract the unigram feature from the token for opinion classification
        """
        # document_words = set(document)
        features = {}
        features['sentiment'] = 0
        features['question'] = 0
        sentiment = 0.0
        negation = False
        for idx, word in enumerate(document):
            # features['contains(%s)' % word] = (word in document_words)
            for kata in self.positive_text:
                if kata in word:
                    if negation:
                        sentiment += self.positive_value[kata]
                        negation = False
                    else:
                        sentiment += self.positive_value[kata]
            for kata in self.negative_text:
                if kata in word:
                    if negation:
                        sentiment += self.negative_value[kata]
                        negation = False
                    else:
                        sentiment += self.negative_value[kata]
            if any(word == s for s in self.negation_text):
                negation = True
            if any(word == s for s in self.question_text):
                features['question'] += 1
        features['sentiment'] = sentiment
        return features

    def kill_char(self, string, n):
        """
        string - a string
        n - n-th position in the string
        This function delete a charater at n position of a string
        """
        begin = string[:n]
        end = string[n + 1:]
        return begin + end

    def save_model(self, filename, classifier):
        """
        filename - the name model file
        classifier - the classifier object
        This function directly save the mode into external file
        """
        f = open(filename, 'wb')
        pickle.dump(classifier, f)
        f.close()

    def load_model(self, filename):
        """
        filename - the name of the model file
        This function load a model from external file and return it
        """
        f = open(filename)
        return pickle.load(f)

    def get_tag_from_corpus(self, filename):
        """
        filename - the name of the corpus file
        this function parse the label or tag of the corpus file
        """
        retval = []
        f = open(filename)
        lines = f.read().split('\n')
        for line in lines:
            retval.append(line[-1])
        return retval

    def get_text_from_corpus(self, filename):
        """
        filename - the name of the corpus file
        this function parse the text of the corpus file
        """
        retval = []
        f = open(filename)
        lines = f.read().split('\n')
        for line in lines:
            retval.append(line[:-2])
        return retval

    def get_text_from_corpus_v2(self, filename):
        """
        filename - the name of the corpus file
        this function parse the text of the corpus file
        """
        retval = []
        f = open(filename)
        lines = f.read().split('\n')
        for line in lines:
            retval.append(line)
        return retval

    def svm_apply_feature(self):
        retval = []
        features = []
        labels = []
        for tweet in self.filtered_tweet:
            words = tweet[0]
            extract = []
            feature = self.extract_features(words)
            for feat in feature.values():
                extract.append(feat)
            features.append(extract)
            labels.append(float(tweet[1]))
        retval.append(features)
        retval.append(labels)
        return retval

    