<p align="center">
  <img src="https://ramantehlan.github.io/AlvisAI/assets/images/comman/logos/logo_blue.png" width="300">  
</p>

# AlvisAI
Alvisai is a social networking web app with a built in bot.

# Requirement

  WAMP, MAMP, LAMP, XAMPP or any other server with PHP, MySQL and Apache installed are required to run this project.

# Installation

**Step 1: Download the project to root directory**

  - Download the project and unzip only in the root directory of your website root or localhost.


**Step 2: Import database to MySQL**

  - You need to import two **.sql** files to MySQL database. Those two files are: `server/sql/alvisai.sql` and `server/sql/alvisai_learn.sql` in the root directory.

**Step 3: Configure program**

  - Now you need to go to `includes/config.inc.php` in the root directory and then change `MYSQL DETAIL AREA` to your MySql details.

**Step 4: Create bot database**

  - Create a new database in MySQL, name it "alvis_bot".


**Step 5: Install Bot**

  - Go to `http://host/ai_box/ai/program_o/install/install_programo.php` where the host can be localhost or your website. Then the installation form will appear. Fill out this form and use "alvis_bot" as its database and other details according to your MySQL database. Finally, click on save.


# Notes

- By step 3, The social networking will get active but it won't have a bot yet. Now we will use [**Program-O**](https://github.com/Program-O/Program-O), which is pre-installed in root directory we just need to initiate bot installation.

- Bot will work by step 5 but you still need to teach your bot other wise it will show default answer. To do that just got to **http://host/ai_box/ai/program_o/admin/** and log in with your Program-O details which you filled in step `Install Bot`.

- AlvisAI is also referred as zimp or zimpbox at various places in app.

**That's it! AlvisAI is alive now** :sparkles: :boom: :sparkles: :boom:

# Contribution

**Author**

- [Raman Tehlan](https://ramantehlan.github.io/)

This repository was archived on 20 July 2019, but you can still fork it and use it as you want.

# License

GNU General Public License v3.0

# Back Story
#### You probably don't want to read it


This web app was designed and developed by me and was launched officially in **2015** with a *vision to help out people in depression, people who are shy to talk about their problems.* I had this vision when I saw my own school friends facing depression issues.


That's when I decided to create a social network with artificial intelligence, a network which could understand your emotions and help you when you feel troubled about something, a network which could talk to you like a human; like a friend. This social network has features like anonymous updates and options to tag your emotions, which are specifically made for shy and depressed users. This app also learns to understand emotions by creating a network between the emotional tags used and then matching them with the kind of words and images they are updating.


But unfortunately, my vision/app didn't get much response, not many people signed up for it and it did a crash landing. I later wrote a (private)document on what went wrong. It was my approach to the problem which didn't fit right. I had to learn it hard way. The irony is that after this I myself got a bit depressed and was disappointed, well I was 16 or 17 maybe and was too excited about this project, so disappointment was quite guaranteed. But I learned a lot and was quite happy and positive in the end.


#### What's in it for you
Well, after 2 years I have decided to open source my web app and if you need a pre-built social network then feel free to edit and use AlvisAI for yourself and others.

# Screenshots

<p >
<img src="https://ramantehlan.github.io/AlvisAI/assets/images/screenshot_1.JPG" width="430px" />
<img src="https://ramantehlan.github.io/AlvisAI/assets/images/screenshot_2.JPG" width="430px" />
<img src="https://ramantehlan.github.io/AlvisAI/assets/images/screenshot_3.JPG" width="430px" />
<img src="https://ramantehlan.github.io/AlvisAI/assets/images/screenshot_4.JPG" width="430px" />
</p>
