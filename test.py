# Importing libraries
print("Importing libraries...")
import csv
import matplotlib.pyplot as plt
import numpy as np
import pandas as pd
import math
print("Libraries imported.\n")

# Reading the CSV file
print("Reading 'players.csv' into a DataFrame...")
df = pd.read_csv("players.csv")
print("CSV loaded. Here's a preview:")
print(df.head(), "\n")

# Declaring global variables
print("Declaring global variables...")
scores_goal = 10000
players = []
print(f"Goal score set to {scores_goal}.\n")

# Score calculation function
print("Defining score calculation function...")
def calcu_scores(kills, assists):
    print(f"Calculating score: ({kills} * 0.7) + ({assists} * 0.3)")
    return (kills * 0.7) + (assists * 0.3)
print("Score function ready.\n")

# Rank assignment function with status labels
print("Defining status assignment function...")
def ranks(score):
    print(f"Determining status for score: {score}")
    if score >= 10000:
        return "Legendary"
    elif score >= 8000:
        return "Elite"
    elif score >= 6000:
        return "Pro"
    elif score >= 4000:
        return "Experienced"
    elif score >= 2000:
        return "Intermediate"
    elif score >= 1000:
        return "Beginner"
    elif score >= 500:
        return "Novice"
    else:
        return "Unranked"
print("Status function ready.\n")

# Display function
print("Defining display function...")
def display(name, score, status):
    print(f"Player: {name} | Score: {score:.2f} | Status: {status}")
print("Display function ready.\n")

# Loop through players
print("Processing each player...\n")
scores = []
status_list = []

for index, row in df.iterrows():
    print(f"Player {index + 1}: {row['Player']}")
    name = row["Player"]
    kills = row["Kills"]
    assists = row["Assists"]
    
    print(f"Kills: {kills},Assists: {assists}")
    score = calcu_scores(kills, assists)
    status = ranks(score)
    
    display(name, score, status)
    scores.append(score)
    status_list.append(status)
    print("Player processed.\n")

# Plotting leaderboard
print("Plotting leaderboard chart...")
plt.figure(figsize=(8, 5))
plt.bar(df["Player"], scores, color='deepskyblue')
plt.axhline(y=scores_goal, color='red', linestyle='--', label='Legendary')
plt.title("Gaming Leaderboard")
plt.xlabel("Player")
plt.ylabel("Score")
plt.legend()
plt.tight_layout()
plt.show()
print("Chart displayed. All steps complete!")
