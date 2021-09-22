from django.urls import path
from . import views

urlpatterns = {
    path('news', views.index, name='index'),
    path('read', views.read, name='read')
}