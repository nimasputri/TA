import httplib
import json
import unicodedata
import urllib


class DataParser:
    API_ROOT_PATH = 'api.nolimitid.com'
    API_PATH = '/research/stream/timeline'
    SOCIAL_TYPE = 1  # 1 for Twitter, 3 for Facebook
    PARAMETER = {'social_type': SOCIAL_TYPE}
    FILE_PATH = 'temp.dat'
    API_KEY = "AIzaSyD-Snv33Fb33EC39h3Kh40ei03nZS_x_OI"

    def getRawData(self, root=API_ROOT_PATH, path=API_PATH, parameter=PARAMETER):
        """
        root - API name server. example: api.nolimitid.com
        path - The API path. example: research/stream/timeline
        parameter - The additional parameter. 1 for Twitter and 3 for Falseacebook
        This function send a HTTP request to the API and return the request as a string
        """
        connection = httplib.HTTPConnection(root)
        request_string = path + '?' + urllib.urlencode(parameter)
        print request_string
        connection.request('GET', request_string)
        response = connection.getresponse()
        if response.status == 200:
            return response.read()
        else:
            return False

    def getJSONData(self, root=API_ROOT_PATH, path=API_PATH, parameter=PARAMETER):
        """
        root - API name server. example: api.nolimitid.com
        path - The API path. example: research/stream/timeline
        parameter - The additional parameter. 1 for Twitter and 3 for Facebook
        This function send a HTTP request to the API and return it as a Python Dictionary
        """
        data = self.getRawData(root, path, parameter)
        if data is not False:
            data = json.loads(data)
            return data
        else:
            return False

    def parseJSONTweetToFile(self, data, filepath=FILE_PATH):
        """
        data - Tweets in JSON
        filepath - The path of the file
        Write Tweet in JSON into file. Automatically convert utf8 into ascii
        """
        berkas = open(filepath, 'a+')
        dat = data['collection']
        for row in dat:
            line = unicodedata.normalize('NFKD', row['content']).encode('ascii', 'ignore')
            berkas.write(line)
            berkas.write('\n')

    def getTweetDataByPage(self, root=API_ROOT_PATH, path=API_PATH, parameter=PARAMETER, filepath=FILE_PATH, page=1, skip=0, next=''):
        """
        root - API name server. example: api.nolimitid.com
        path - The API path. example: research/stream/timeline
        parameter - The additional parameter. 1 for Twitter and 3 for Facebook
        filepath - The path of the file
        page - number of page to be read
        This function automatically read the API data and write it into file
        """
        skip_count = skip
        if page < 1:
            return False
        count = 0
        if next != '':
            parameter = self.PARAMETER
            parameter['next'] = next
        data = self.getJSONData(parameter=parameter)
        if skip_count <= 0:
            self.parseJSONTweetToFile(data, filepath)
        skip_count -= 1
        count += 1
        if count < page:
            while count < page + skip:
                print count, page, skip, skip_count
                parameter['next'] = data['next']
                data = self.getJSONData(parameter=parameter)
                if skip_count <= 0:
                    self.parseJSONTweetToFile(data=data)
                else:
                    skip_count -= 1
                count += 1
        return True
