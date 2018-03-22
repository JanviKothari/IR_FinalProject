# homework 4
# goal: ranked retrieval, PageRank, crawling
# exports:
#   student - a populated and instantiated cs525.Student object
#   PageRankIndex - a class which encapsulates the necessary logic for
#     indexing and searching a corpus of text documents and providing a
#     ranked result set




# ########################################
# now, write some code
# ########################################
import bs4
from bs4 import BeautifulSoup   # you will want this for parsing html documents
import numpy as np 
import requests
import re
from selenium import webdriver

inverted_index = {}
listno = []
webaddress=[]
pageno=0

def scrape_listings():
    driver = webdriver.Chrome(executable_path="C:\\WPI\\InfoRet\\FinalProject\\chromedriver.exe")
    driver.get('https://www.airbnb.com/s/Boston--MA/homes?refinement_paths%5B%5D=%2Fhomes&allow_override%5B%5D=&checkin=2018-03-27&checkout=2018-03-31&s_tag=uZ2vNwRa&ib=true')
    html = driver.page_source
    soup = BeautifulSoup(html)

    for i in soup.find_all('div', attrs={'itemprop':'itemListElement'}):
        for j in i.find_all('div'):
            output=j.get('id')
            if output != None and output[:7]=="listing":
                if output[9:] not in listno:
                    listno.append(output[9:])
                    for j in soup.find_all('div',attrs={'id' : output}):
                        for div in j:
                            webaddress.append(div.a['href'])
    nextpage
    return 


scrape_listings()

x=soup.find_all('nav')
z=x.find_all('div')
print(z)
len(x)      
print(x)  
for i in 
for x in soup.find_all('nav'):
    for div in x:
        print(div.a['href'])
        
    


