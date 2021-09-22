from django.shortcuts import render
from django.http import HttpResponse

from bs4 import BeautifulSoup
import requests

# Create your views here.
def index(request):
    html_text = requests.get('https://www.business-standard.com/technology-news').text
    soup = BeautifulSoup(html_text, 'lxml')
    headlines = soup.find_all('div', class_ = 'listing-txt')
    headline = {}

    for heading in headlines: 
        temp = heading.find('a')
        temp2 = temp.text
        temp2 = temp2.strip()
        details = temp.attrs['href']
        detail_url = 'https://www.business-standard.com' + details

        headline[temp2] = detail_url

    return render(request, 'index.html', {'headlines_data': headline})

def read(request):
    if request.method == 'GET':
        return HttpResponse('Select News First')
    headline = request.POST['headline']
    read_link = request.POST['read_link']
    detail_text = requests.get(read_link).text
    soup2 = BeautifulSoup(detail_text, 'lxml')
    detail = soup2.find('span', class_ = 'p-content')
    temp = detail.text

    del_text = 'vc/vd'
    temp = temp.replace(del_text,'')
    del_text = 'vc/bg'
    temp = temp.replace(del_text,'')
    del_text = '(Only the headline and picture of this report may have been reworked by the Business Standard staff; the rest of the content is auto-generated from a syndicated feed.)'
    temp = temp.replace(del_text,'')
    del_text = '--IANS'
    temp = temp.replace(del_text,'')
    temp = temp.strip()

    news_date = soup2.find('p', class_ = 'fL')
    news_date2 = news_date.find_all('span')
    news_date3 = ''
    for item in news_date2:
        news_date3 = item.text
    news_date3 = news_date3.replace('Last Updated at ','')
    news_date3 = news_date3.strip()

    return render(request, 'read.html', {'headline_data': headline, 'detail_data': temp, 'date_data': news_date3})