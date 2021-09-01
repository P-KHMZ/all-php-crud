-- =========DATABASE====================
-- ReadMe: I've willingly designed the databases like that because 
-- it will be sufficent to make the code run properly.

-- **********HOW TO PROCEED***********
-- 1. install Xampp on computer
-- 2. go to phpmyadmin(just copy and paste this is your browser's 
-- address bar:"http://localhost/phpmyadmin/")
-- 3. create your database with the name I have indicated here below

-- Note: each database correspond to functionality
-- for example: logindb is used for login forms; Yes I know it is not professional but I 
-- have done that with a personal purpose bare with me.


-- database name1:all-crude-php
-- table: users_table
-- columns: userId(mediumint,6, primary key, unsigned, AI), firstName, lastName, email, password(size: 40), registration_date

-- database name2: logindb
-- table: users
-- columns: user_Id, fname, lname, email, psword, registration_date, user_level(tinyint, size = 1, unsigned)
--  database name3: admintable
--  table users
--  columns: user_Id, fname, lname, email, psword, registration_date, user_level