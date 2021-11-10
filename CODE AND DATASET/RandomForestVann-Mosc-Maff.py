#!/usr/bin/env python3
# -*- coding: utf-8 -*-
"""


@author: Gruppo VANNELLA-MOSCHESE-MAFFIONE
"""
import numpy as np, pandas as pd, seaborn as sn
from imblearn.over_sampling import SMOTE
from sklearn.ensemble import RandomForestClassifier
from sklearn.model_selection import train_test_split, cross_val_score
from sklearn.metrics import classification_report, confusion_matrix, accuracy_score, f1_score 
from sklearn.metrics import precision_recall_curve
from inspect import signature
from sklearn.metrics import average_precision_score
from sklearn.metrics import roc_curve
from sklearn.metrics import roc_auc_score
from matplotlib import pyplot
import matplotlib.pyplot as plt


feature = ["A1_Score","A2_Score","A3_Score","A4_Score","A5_Score","A6_Score","A7_Score","A8_Score","A9_Score","A10_Score","age","gender","ethnicity","jundice","austim","used_app_before","result","relation","Class/ASD"]
feature_dummied = ["A1_Score","A2_Score","A3_Score","A4_Score","A5_Score","A6_Score","A7_Score","A8_Score","A9_Score","A10_Score","age","gender","ethnicity","jundice","austim","used_app_before","result","relation"]
dataset = pd.read_csv("Autism-Dataset.csv", sep=",", names=feature, dtype={'A1_Score':object,'A2_Score':object,'A3_Score':object,'A4_Score':object,'A5_Score':object,'A6_Score':object,'A7_Score':object,'A8_Score':object,'A9_Score':object,'A10_Score':object,'age':object,'gender':object,'ethnicity':object,'jundice':object,'austim':object,'used_app_before':object,'result':object,'relation':object, 'Class/ASD':object})
data_dummies = pd.get_dummies(dataset, columns=feature_dummied)
data_dummies = data_dummies.drop(["Class/ASD"], axis=1)

X = data_dummies
y = pd.get_dummies(dataset["Class/ASD"], columns=["Class/ASD"])
y = y["1"]

oversample = SMOTE()
X1, y1 = oversample.fit_resample (X, y)

X1_train, X1_test, y1_train, y1_test = train_test_split(X1, y1, train_size = 0.7, random_state = 13)


clf = RandomForestClassifier(n_estimators=20, random_state=0)  
clf1 = clf.fit(X1_train, y1_train) 

prediction = clf1.predict(X1_test)
accuracy = accuracy_score(prediction, y1_test)

print ('\nClasification report:\n',classification_report(y1_test, prediction))
print ('\nConfussion matrix:\n',confusion_matrix(y1_test, prediction))

confusion_matrix = confusion_matrix(y1_test, prediction)
df_cm = pd.DataFrame(confusion_matrix, index = [i for i in "01"], columns = [i for i in "01"])
plt.figure(figsize = (10,7))
sn.heatmap(df_cm, annot=True)

#train model with cv of 5 
cv_scores = cross_val_score(clf, X1, y1, cv=5)

print('\ncv_scores mean:{}'.format(np.mean(cv_scores)))
print('\ncv_score variance:{}'.format(np.var(cv_scores)))
print('\ncv_score dev standard:{}'.format(np.std(cv_scores)))
print('\n')



probs = clf.predict_proba(X1_test)
# keep probabilities for the positive outcome only
probs = probs[:, 1]

auc = roc_auc_score(y1_test, probs)
print('AUC: %.3f' % auc)
# calculate roc curve
fpr, tpr, thresholds = roc_curve(y1_test, probs)
# plot no skill
pyplot.plot([0, 1], [0, 1], linestyle='--')
# plot the roc curve for the model
pyplot.plot(fpr, tpr, marker='.')
pyplot.xlabel('FP RATE')
pyplot.ylabel('TP RATE')
# show the plot
pyplot.show()


average_precision = average_precision_score(y1_test, prediction)
precision, recall, _ = precision_recall_curve(y1_test, prediction)

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

f1 = f1_score(y1_test, prediction)

data = {'variance': np.var(cv_scores), 'standard dev': np.std(cv_scores)}
names = list(data.keys())
values = list(data.values())
fig,axs = plt.subplots(1, 1, figsize=(6, 3), sharey=True)
axs.bar(names, values)
