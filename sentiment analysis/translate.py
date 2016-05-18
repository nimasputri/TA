__author__ = 'edwinlunando@gmail.com (Edwin Lunando)'

from apiclient.discovery import build


class Translator:
    API_KEY = "AIzaSyD-Snv33Fb33EC39h3Kh40ei03nZS_x_OI"

    def __init__(self):
        self.service = build('translate', 'v2', developerKey=self.API_KEY)

    def translate(self,  q_words=[], source_lang='en', target_lang='id'):
        self.translate = self.service.translations()
        data = self.translate.list(
            source=source_lang,
            target=target_lang,
            q=q_words
            ).execute()
        retval = []
        for value in data['translations']:
            retval.append(value['translatedText'])
        return retval

    def translate_one_word(self, word='', source_lang='en', target_lang='id'):
        self.translate = self.service.translations()
        query = []
        query.append(word)
        data = self.translate.list(
            source=source_lang,
            target=target_lang,
            q=query
            ).execute()
        return data['translations'][0]['translatedText']


def main():
    # pass
    # Build a service object for interacting with the API. Visit
    # the Google APIs Console <http://code.google.com/apis/console>
    # to get an API key for your own application.
    # service = build('translate', 'v2',
    #         developerKey='AIzaSyD-Snv33Fb33EC39h3Kh40ei03nZS_x_OI')
    # print service.translations().list(
    #   source='en',
    #   target='fr',
    #   q=['flower', 'car']
    #   ).execute()
    translate = Translator()
    # # print translate.translate(['in', 'on'])
    print translate.translate_one_word('hope')


if __name__ == '__main__':
    main()
