A Simple Malware detection website
====================

This app is the final project for server side programming class CS 174.

The idea is to create a web-based Antivirus application that allows the users to upload a file (of any type) to check if it contains malicious content. That is, if it is a Malware or not.

Features:

Web pages:

    - Ensures a secure Session mechanism.
    - Allows the user to submit a putative infected file and shows if it is infected or not.
    - Lets authenticate an Admin and allows him/her to submit a Malware file, plus the name of the uploaded Malware.
    - When an Admin adds the name of a malware during the uploading of a Malware file, it ensures that the string contains only English letters (capitalized or not) and digits. Any other character, or an empty string, must be avoided. 

 
Web Application:

    - Reads the file in input, per bytes, and, if is Malware, stores the sequence of bytes, say, the first 20 bytes (signature) of the file, in a database (Note: only an Admin can upload a Malware file)
    - Reads the file in input, per bytes, and, if it is a putative infected file, searches within the file for one of the strings stored in the database (Note: a normal user will always upload putative infected files)

 
MySQL database:

    - Stores the information regarding the infected files in input, such as name of the malware (not the name of the file) and the sequence of bytes
    - Stores the information related to the Admin with username and password, in the most secure way of your knowledge.


I additionally implemented a routing system, helper classes and an installation script.

More information about the flow of the application can be found in config.php


The basic mvc setup was inspired from: http://requiremind.com/a-most-simple-php-mvc-beginners-tutorial/


## License

MIT License (MIT)

Copyright (c) <2013> <Neil Rosenstech>

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.