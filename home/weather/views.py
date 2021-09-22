from django.shortcuts import render
from django.http import HttpResponse, response
import requests, json

# Create your views here.

def index(request):
    API_key = '05b761485ad142888ce152651211409'
    City = 'Lucknow'
    Location = "Enter Location"
    requestURL = 'http://api.weatherapi.com/v1/forecast.json?key=' + API_key + '&q=' + City + '&days=7&aqi=yes&alerts=no'
    responseData = requests.get(requestURL)
    responseData = responseData.json()
    City = responseData['location']['name']
    Country = responseData['location']['country']
    Region = responseData['location']['region']
    if len(Country) > 15 and len(Region) < 15:
        Location = responseData['location']['name'] + ', ' + Region
    else:
        Location = responseData['location']['name'] + ', ' + Country
    DateTime = responseData['location']['localtime']
    TemperatureC = responseData['current']['temp_c']
    WeatherDetails = responseData['current']['condition']['text']
    DayNight = responseData['current']['is_day']
    Wind = responseData['current']['wind_kph']
    Pressure = responseData['current']['pressure_mb'] * 1000
    Humidity = responseData['current']['humidity']
    FeelsLike = responseData['current']['feelslike_c']
    UVIndex = responseData['current']['uv']

    Visibility = responseData['current']['vis_km']
    MaxC = responseData['forecast']['forecastday'][0]['day']['maxtemp_c']
    MinC = responseData['forecast']['forecastday'][0]['day']['mintemp_c']
    Precipitation = responseData['forecast']['forecastday'][0]['day']['daily_chance_of_rain']
    SunRise = responseData['forecast']['forecastday'][0]['astro']['sunrise']
    SunSet = responseData['forecast']['forecastday'][0]['astro']['sunset']
    AirQuality = responseData['current']['air_quality']['us-epa-index']

    #Date Time Operations
    Time = DateTime[-5:]
    Hour = Time[:2]
    Minute = Time[-2:]
    Dates = DateTime[:10]
    Date = DateTime[8:10]
    Month = DateTime[5:7]
    AMPM = 'AM'
    if int(Time[0:2]) == 0:
        Hour = 12
    if int(Time[0:2]) > 12:
        AMPM = 'PM'
        Hour = int(Time[0:2]) - 12
        if Hour < 10:
            Hour = "0" + str(Hour)


    MonthDict = {'01':'Janauary','02':'February','03':'March','04':'April','05':'May','06':'June','07':'July','08':'August','09':'September','10':'October','11':'November','12':'December'}
    Month = MonthDict[Month]

    #TIMEAPI
    requestURL = 'https://www.timeapi.io/api/Conversion/DayOfTheWeek/' + Dates
    responseData = requests.get(requestURL)
    responseData = responseData.json()
    Day = responseData['dayOfWeek']

    #Metric Bar Calculations
    MBar1 = str(Humidity) + 'px'
    MBar2 = str(Precipitation) + 'px'
    MBar3 = str(AirQuality * 10) + 'px'
    MBar4 = str(int(UVIndex) * 10) + 'px'

    #AirQuality Conversion
    if AirQuality == 1:
        AirQuality = 'Good'
    elif AirQuality == 2:
        AirQuality = 'Moderate'
    elif AirQuality == 3 :
        AirQuality = 'Poor'
    elif AirQuality == 4 or AirQuality == 5:
        AirQuality = 'Unhealthy'
    else:
        AirQuality = 'Hazardous'


    return render(request, 'weather.html', {'MBar1': MBar1 , 'MBar2': MBar2 , 'MBar3': MBar3 , 'MBar4': MBar4 , 'SearchData': Location, 'CityData': City, 'TempC': TemperatureC, 'WeatherData': WeatherDetails, 'DayData': DayNight, 'WindData': Wind, 'FeelsLikeData': FeelsLike, 'HumidityData': Humidity, 'UVIndexData': UVIndex, 'AirQualityData': AirQuality, 'HourData': Hour, 'MinuteData': Minute, 'TodayData': Day, 'MonthData': Month, 'DateData': Date, 'AMPMData': AMPM, 'MaxCData': MaxC, 'MinCData': MinC, 'PrecipitationData': Precipitation, 'SunRiseData': SunRise, 'SunSetData': SunSet})


def searchCity(request):
    API_key = '05b761485ad142888ce152651211409'
    cityName = request.POST['cityName']
    requestURL = 'http://api.weatherapi.com/v1/forecast.json?key=' + API_key + '&q=' + cityName + '&days=7&aqi=yes&alerts=no'
    responseData = requests.get(requestURL)
    responseData = responseData.json()
    City = responseData['location']['name']
    Country = responseData['location']['country']
    Region = responseData['location']['region']
    if len(Country) > 15 and len(Region) < 15:
        Location = responseData['location']['name'] + ', ' + Region
    else:
        Location = responseData['location']['name'] + ', ' + Country
    DateTime = responseData['location']['localtime']
    TemperatureC = responseData['current']['temp_c']
    WeatherDetails = responseData['current']['condition']['text']
    DayNight = responseData['current']['is_day']
    Wind = responseData['current']['wind_kph']
    Pressure = responseData['current']['pressure_mb'] * 1000
    Humidity = responseData['current']['humidity']
    FeelsLike = responseData['current']['feelslike_c']
    UVIndex = responseData['current']['uv']
    AirQuality = responseData['current']['air_quality']['us-epa-index']
 
    Visibility = responseData['current']['vis_km']
    MaxC = responseData['forecast']['forecastday'][0]['day']['maxtemp_c']
    MinC = responseData['forecast']['forecastday'][0]['day']['mintemp_c']
    Precipitation = responseData['forecast']['forecastday'][0]['day']['daily_chance_of_rain']
    SunRise = responseData['forecast']['forecastday'][0]['astro']['sunrise']
    SunSet = responseData['forecast']['forecastday'][0]['astro']['sunset']

    #Date Time Operations
    Time = DateTime[-5:]
    Hour = Time[:2]
    Minute = Time[-2:]
    Dates = DateTime[:10]
    Date = DateTime[8:10]
    Month = DateTime[5:7]
    AMPM = 'AM'
    if int(Time[0:2]) == 0:
        Hour = 12
    if int(Time[0:2]) > 12:
        AMPM = 'PM'
        Hour = int(Time[0:2]) - 12
        if Hour < 10:
            Hour = "0" + str(Hour)


    MonthDict = {'01':'Janauary','02':'February','03':'March','04':'April','05':'May','06':'June','07':'July','08':'August','09':'September','10':'October','11':'November','12':'December'}
    Month = MonthDict[Month]

    #TIMEAPI
    requestURL = 'https://www.timeapi.io/api/Conversion/DayOfTheWeek/' + Dates
    responseData = requests.get(requestURL)
    responseData = responseData.json()
    Day = responseData['dayOfWeek']

    #Metric Bar Calculations
    MBar1 = str(Humidity) + 'px'
    MBar2 = str(Precipitation) + 'px'
    MBar3 = str(AirQuality * 10) + 'px'
    MBar4 = str(int(UVIndex) * 10) + 'px'

    #AirQuality Conversion
    if AirQuality == 1:
        AirQuality = 'Good'
    elif AirQuality == 2:
        AirQuality = 'Moderate'
    elif AirQuality == 3 :
        AirQuality = 'Poor'
    elif AirQuality == 4 or AirQuality == 5:
        AirQuality = 'Unhealthy'
    else:
        AirQuality = 'Hazardous'


    return render(request, 'weather.html', {'MBar1': MBar1 , 'MBar2': MBar2 , 'MBar3': MBar3 , 'MBar4': MBar4 , 'SearchData': Location, 'CityData': City, 'TempC': TemperatureC, 'WeatherData': WeatherDetails, 'DayData': DayNight, 'WindData': Wind, 'FeelsLikeData': FeelsLike, 'HumidityData': Humidity, 'UVIndexData': UVIndex, 'AirQualityData': AirQuality, 'HourData': Hour, 'MinuteData': Minute, 'TodayData': Day, 'MonthData': Month, 'DateData': Date, 'AMPMData': AMPM, 'MaxCData': MaxC, 'MinCData': MinC, 'PrecipitationData': Precipitation, 'SunRiseData': SunRise, 'SunSetData': SunSet})