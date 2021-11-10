#!/usr/bin/env python3
# -*- coding: utf-8 -*-
"""


@author: Gruppo VANNELLA-MOSCHESE-MAFFIONE
"""

# roc curve and auc
import numpy as np, pandas as pd, seaborn as sn
from sklearn.cluster import KMeans  
import seaborn as sns; sns.set()  
from sklearn.metrics import accuracy_score, confusion_matrix, classification_report 
import matplotlib.pyplot as plt
from sklearn.metrics import average_precision_score
from sklearn.metrics import precision_recall_curve
from inspect import signature

feature = ["A1_Score","A2_Score","A3_Score","A4_Score","A5_Score","A6_Score","A7_Score","A8_Score","A9_Score","A10_Score","age","gender","ethnicity","jundice","austim","used_app_before","result","relation","Class/ASD"]
feature_dummied = ["A1_Score","A2_Score","A3_Score","A4_Score","A5_Score","A6_Score","A7_Score","A8_Score","A9_Score","A10_Score","age","gender","ethnicity","jundice","austim","used_app_before","result","relation"]
dataset = pd.read_csv("Autism-Dataset.csv", sep=",", names=feature, dtype={'A1_Score':object,'A2_Score':object,'A3_Score':object,'A4_Score':object,'A5_Score':object,'A6_Score':object,'A7_Score':object,'A8_Score':object,'A9_Score':object,'A10_Score':object,'age':object,'gender':object,'ethnicity':object,'jundice':object,'austim':object,'used_app_before':object,'result':object,'relation':object, 'Class/ASD':object})
data_dummies = pd.get_dummies(dataset, columns=feature_dummied)
data_dummies = data_dummies.drop(["Class/ASD"], axis=1)

X = data_dummies
y = pd.get_dummies(dataset["Class/ASD"], columns=["Class/ASD"])
y = y["1"]

kmeans = KMeans(n_clusters = 2, init = 'k-means++', max_iter = 2, n_init = 9, random_state = 0)
y_kmeans = kmeans.fit_predict(X)

centroids = kmeans.cluster_centers_

print("\nEtichette:")  
print(kmeans.labels_)

print ('\nClasification report:\n',classification_report(y, y_kmeans))
print ('\nConfussion matrix:\n',confusion_matrix(y, y_kmeans))

average_precision = average_precision_score(y, y_kmeans)
precision, recall, _ = precision_recall_curve(y, y_kmeans)


# In matplotlib < 1.5, plt.fill_between does not have a 'step' argument
step_kwargs = ({'step': 'post'}
               if 'step' in signature(plt.fill_between).parameters
               else {})
plt.step(recall, precision, color='b', alpha=0.2,
         where='post')
plt.fill_between(recall, precision, alpha=0.2, color='b', **step_kwargs)

plt.xlabel('Recall')
plt.ylabel('Precision')
plt.ylim([0.0, 1.05])
plt.xlim([0.0, 1.0])
plt.title('2-class Precision-Recall curve: AP={0:0.2f}'.format(average_precision))
plt.show()

accuracy = accuracy_score(y_kmeans, y)
