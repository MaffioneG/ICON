# -*- coding: utf-8 -*-
"""


@author: Gruppo VANNELLA-MOSCHESE-MAFFIONE
"""

import numpy as np, pandas as pd, seaborn as sn
from imblearn.over_sampling import SMOTE
from sklearn.model_selection import train_test_split, cross_val_score
from sklearn.metrics import classification_report, confusion_matrix, accuracy_score, f1_score, precision_score, make_scorer, recall_score 
from keras.wrappers.scikit_learn import KerasClassifier
from keras.models import Sequential
from keras import models
from keras.layers import Dense
from sklearn.metrics import precision_recall_curve
from inspect import signature
from sklearn.metrics import average_precision_score
from sklearn.metrics import roc_curve
from sklearn.metrics import roc_auc_score
from matplotlib import pyplot
import matplotlib.pyplot as plt
#----------------------------------------------------------------------------------------------------------

# create model
def create_model():
        
    network = Sequential()
    network.add(Dense(30,input_dim=90, activation="relu"))
    network.add(Dense(1, activation='sigmoid'))
    # Compile model
    network.compile(loss='binary_crossentropy', optimizer='adam', metrics=['accuracy'])
    
    return network

#----------------------------------------------------------------------------------------------------------

np.random.seed(7)

dataset = pd.read_csv("Autism-Dataset.csv", sep=",", names=["A1_Score","A2_Score","A3_Score","A4_Score","A5_Score","A6_Score","A7_Score","A8_Score","A9_Score","A10_Score","age","gender","ethnicity","jundice","austim","used_app_before","result","relation","Class/ASD"],
                      dtype={'A1_Score':object,'A2_Score':object,'A3_Score':object,'A4_Score':object,'A5_Score':object,'A6_Score':object,'A7_Score':object,'A8_Score':object,'A9_Score':object,'A10_Score':object,'age':object,'gender':object,'ethnicity':object,'jundice':object,'austim':object,'used_app_before':object,'result':object,'relation':object, 'Class/ASD':object})
network_data = pd.get_dummies(dataset, columns=["A1_Score","A2_Score","A3_Score","A4_Score","A5_Score","A6_Score","A7_Score","A8_Score","A9_Score","A10_Score","age","gender","ethnicity","jundice","austim","used_app_before","result","relation"])

network_data = network_data.drop(["Class/ASD"], axis=1)

X = network_data
y = pd.get_dummies(dataset["Class/ASD"], columns=["Class/ASD"])
y = y["1"]

oversample = SMOTE()
X, y = oversample.fit_resample (X, y)
X_train, X_test, y_train, y_test = train_test_split(X, y, train_size = 0.75, random_state = 13)


model = create_model()

print(model)
# Fit the model


model.fit(X_train, y_train, epochs=100, batch_size=19) 

scores = model.evaluate(X_train, y_train)
print("\n%s: %.2f%%" % (model.metrics_names[1], scores[1]*100))

# calculate predictions
predictions = model.predict(X_test)
rounded = [round(x[0]) for x in predictions]

accuracy = accuracy_score(y_test, rounded)

print ('\nClasification report:\n',classification_report(y_test, rounded))
print ('\nConfussion matrix:\n',confusion_matrix(y_test, rounded))

confusion_matrix = confusion_matrix(y_test, rounded)
df_cm = pd.DataFrame(confusion_matrix, index = [i for i in "01"], columns = [i for i in "01"])
plt.figure(figsize = (10,7))
#sn.heatmap(df_cm, annot=True)

model1 = KerasClassifier(build_fn=create_model, epochs=100, batch_size=19, verbose=0)

cv_scores = cross_val_score(model1, X, y, cv=5)
print(cv_scores)
print('\ncv_scores mean:{}'.format(np.mean(cv_scores)))
print('\ncv_score variance:{}'.format(np.var(cv_scores)))
print('\ncv_score dev standard:{}'.format(np.std(cv_scores)))


probs = model.predict (X_test)
# keep probabilities for the positive outcome only
probs = probs[:, 0]

auc = roc_auc_score(y_test, probs)
print('AUC: %.3f' % auc)
# calculate roc curve
fpr, tpr, thresholds = roc_curve(y_test, probs)
# plot no skill
pyplot.plot([0, 1], [0, 1], linestyle='--')
# plot the roc curve for the model
pyplot.plot(fpr, tpr, marker='.')
pyplot.xlabel('FP RATE')
pyplot.ylabel('TP RATE')
# show the plot
pyplot.show()


average_precision = average_precision_score(y_test, rounded)
precision, recall, _ = precision_recall_curve(y_test, rounded)

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

f1 = f1_score(y_test, rounded)


data = {'variance': np.var(cv_scores), 'standard dev': np.std(cv_scores)}
names = list(data.keys())
values = list(data.values())
fig,axs = plt.subplots(1, 1, figsize=(6, 3), sharey=True)
axs.bar(names, values)

print(accuracy)
