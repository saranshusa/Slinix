from django.shortcuts import render
from django.http import HttpResponse

# Create your views here.

def index(request):
    alert = '<h3 style="text-align: center; font-size: 5rem">Website Under Development<h3>'
    return HttpResponse(alert)