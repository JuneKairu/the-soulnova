import numpy as np
import pandas as pd
import matplotlib.pyplot as plt
import seaborn as sns; sns.set()

from sklearn.feature_extraction.text import TfidfVectorizer
from sklearn.naive_bayes import GaussianNB
from sklearn.decomposition import PCA

df = pd.read_csv("emails.csv")
df = df[df['label'].isin(['important', 'spam'])]

print("All Emails:")
print(df.head(10))
print(f"Total emails: {len(df)}")
print(f"Spam: {(df['label'] == 'spam').sum()}, Important: {(df['label'] == 'important').sum()}")

y = df['label'].map({'spam': 0, 'important': 1})

vectorizer = TfidfVectorizer(stop_words='english')
X = vectorizer.fit_transform(df['text']).toarray()

gnb = GaussianNB()
gnb.fit(X, y)

pca = PCA(n_components=2)
X_2d = pca.fit_transform(X)

fig, ax = plt.subplots(figsize=(10, 6))

ax.scatter(X_2d[:, 0], X_2d[:, 1], c='#FFA089', s=20, label='All Emails', alpha=0.3)

colors = np.array(['red' if label == 0 else 'green' for label in y])
ax.scatter(X_2d[:, 0], X_2d[:, 1], c=colors, s=50, edgecolors='k')

ax.set_title('Naive Bayes Model', size=14)

handles = [
    plt.Line2D([0], [0], marker='o', color='w', label='Spam',
               markerfacecolor='red', markersize=10, markeredgecolor='k'),
    plt.Line2D([0], [0], marker='o', color='w', label='Important',
               markerfacecolor='green', markersize=10, markeredgecolor='k')
]
ax.legend(handles=handles, title="Legend", loc='upper right')

xlim = (X_2d[:, 0].min() - 1, X_2d[:, 0].max() + 1)
ylim = (X_2d[:, 1].min() - 1, X_2d[:, 1].max() + 1)

xg = np.linspace(xlim[0], xlim[1], 60)
yg = np.linspace(ylim[0], ylim[1], 40)
xx, yy = np.meshgrid(xg, yg)
Xgrid = np.vstack([xx.ravel(), yy.ravel()]).T

for label, color in zip([0, 1], ['red', 'green']):
    mask = (y == label)
    mu = X_2d[mask].mean(0)
    std = np.array([X_2d[:, 0].std(), X_2d[:, 1].std()])
    P = np.exp(-0.5 * (Xgrid - mu) ** 2 / std ** 2).prod(1)
    Pm = np.ma.masked_array(P, P < 0.03)

    ax.imshow(Pm.reshape(xx.shape), extent=(xlim[0], xlim[1], ylim[0], ylim[1]),
              origin='lower', alpha=0.5, cmap=color.title() + 's', aspect='auto')

    ax.contour(xx, yy, P.reshape(xx.shape),
               levels=[0.01, 0.1, 0.5, 0.9],
               colors=color, alpha=0.2)

ax.set(xlim=xlim, ylim=ylim)
plt.tight_layout()
plt.show()
