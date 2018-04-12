# Get started with interactive Python!

import os
import random
import operator
import numpy  
from glob import glob
import pandas as pd


listings_dict={}
clusters_dict={}

path='C:\\WPI\\InfoRet\\FinalProject\\test\\'

for fn in glob("%s/*" % path):
    for line in open(fn,encoding="utf8"):
        raw=line.strip("['\n]").split(',')
        if(len(raw)<6):
            continue
        if raw[0]!="listing_id":
            listing=listings_dict.get(raw[0],[])
            #print(raw)
            #print(listings)
            #print(raw[1:6])
            listing.append(raw[1:6])
            listings_dict[raw[0]]=listing
#print(data[0])
#print(listings_dict.get('7441144',[]))

for k,v in listings_dict.items():
  reviews=[]
  clusters={}
  print('\nLISTING NUMBER: '+str(k)+'\n')
  if len(v)>10:
    x=round(min(len(v)/4, 50),0)
    rand=[]
    while len(rand)<x:
        no=random.randint(0,(len(v)-1))
        if no not in rand:
            rand.append(no)
  else:
      rand=range(0,len(v)-1)
      
  ############CYCLE THROUGH REVIEWS    
  cnt=0
  for review in v: 
    if cnt in rand:  
        print('\nNEW REVIEW\n')
        print(review[4])
        score=input('\nPlease rate review as Neg(1), Neutral(2) or Pos(3)')
        review.append(score)
        if len(reviews)==0:
            print('First review for listing has been assigned to cluster 0')
            reviews.append(review[4])
            cluster=clusters.get(0,[])
            cluster.append(review[0])
            clusters[0]=cluster
            os.system('clear')
        else:
            print('\nCLUSTER ASSIGNMENT')
            clust_no=0
            match=False
            while (match==False and clust_no<=len(reviews)):
                print('clust_no'+str(clust_no))
                print('len'+str(len(reviews)))
                print('Do these reviews match?\n')
                print(reviews[clust_no])
                assign=input('\nYes(Y)/No(N)')
                if assign=="Y":
                    #reviews.append(review[4])
                    cluster=clusters.get(clust_no,[])
                    cluster.append(review[0])
                    clusters[clust_no]=cluster
                    match=True
                    os.system('clear')
                if assign=="N":
                    clust_no+=1
                    if clust_no==len(reviews):
                        reviews.append(review[4])
                        cluster=clusters.get(clust_no,[])
                        cluster.append(review[0])
                        clusters[clust_no]=cluster
                        match=True
                        os.system('clear')
    cnt+=1
  dicti=clusters_dict.get(k,[])
  dicti.append(clusters)
  clusters_dict[k]=dicti
  print('clusters')
  print(clusters_dict)
    
    
  
clust_df=pd.DataFrame.from_dict(clusters_dict,orient='index')
  
clust_df.to_csv('C:\\WPI\\InfoRet\\FinalProject\\results\\output_cluster.csv', encoding='utf-8')    

review_df= pd.DataFrame.from_dict(listings_dict,orient='index')
print(review_df)  

review_df.to_csv('C:\\WPI\\InfoRet\\FinalProject\\results\\output_reviews.csv', encoding='utf-8')     
          
        
        

