<<<<<<< HEAD
﻿![ASU | Home](images/images/images/Aspose.Words.e765f280-7fcf-45ac-a826-6d1711082731.001.png)

<a name="_hlk107167839"></a>**CSE496: Graduation Project 2**

**MyRepo – Smart Cloud Storage as a Service**

**Project Documentation**

Project Supervisor:

Prof. Sherin Moussa

Team Members:

Marco Kamal Saad – 17P6018

Ahmed Fawzy Amer – 17P6035

Maomen Soliman Moussa– 17P8247
# Contents
[Chapter 1: MyRepo	2****](#_toc107323736)**

[Introduction	2](#_toc107323737)

[Problem Definition	3](#_toc107323738)

[Objective of the Project	4](#_toc107323739)

[Chapter 2: Related Systems	5****](#_toc107323740)

[Chapter 3: MyRepo Design	7****](#_toc107323741)

[Chapter 4: SERVER	15****](#_toc107323742)

[Server Hardware Details:	15](#_toc107323743)

[Server Configuration	15](#_toc107323744)

[Chapter 5: BACK-END	30****](#_toc107323745)

[Languages used	30](#_toc107323746)

[Structure	30](#_toc107323747)

[Database	30](#_toc107323748)

[ER Diagram	31](#_toc107323749)

[Chapter 6: FRONT-END	32****](#_toc107323750)

[Login Page	32](#_toc107323751)

[Register Page	33](#_toc107323752)

[Diagram	34](#_toc107323753)

[Encryption and Decryption Diagram	34](#_toc107323754)

[Implementation	35****](#_toc107323755)

[DB_Connection	35](#_toc107323756)

[Login	35](#_toc107323757)

[Register	36](#_toc107323758)

[upload-form	37](#_toc107323759)

[Login page	39](#_toc107323760)

[Register Page	40](#_toc107323761)

[Home Page	42](#_toc107323762)

[Encryption logic	43](#_toc107323763)

[Decryption Logic	44](#_toc107323764)

[References	45****](#_toc107323765)


# <a name="_toc107323736"></a>**Chapter 1: MyRepo**
## <a name="_toc107323737"></a>Introduction
Cloud Computing, or “The Cloud”, is a term most of us became familiar with recently. The cloud is the delivery of computing services over the internet. Instead of the traditional method, which was: invest in your hardware upfront and the profits will pay back this investment after X years. This approach naturally results in high CAPEX (Capital Expenditure) and it’s expected to have lower OPEX (Operational Expenditure) although this is not always guaranteed. This model is still viable and useful for large-scale projects that are expected to serve a large base of users and expected to operate for decades. However, this approach as we introduced it, is not suitable for everyone. In fact, it is not suitable for the vast majority of small and medium businesses – let alone for individuals who seek computing services for personal use, services that have become crucial to have in our decade.

We have been only discussing the cost-benefit of choosing cloud over the traditional buy-your-hardware approach, but clouding has other major benefits such as:

**- Productivity and Security:** users don’t need to worry about the hardware, and its maintenance and security measures as they are handled by the provider.

**- Reliability:** The cost of backups and replications is minimum in the cloud model.

**- Scalability:** Users have control over the resources they are paying for instantaneously per their demand, something that is not possible in the traditional approach

\-

Cloud computing has 3 Types, each type offers users a different level of control and access:

**1- Software As A Service (SAAS),** where the software services are hosted and managed by the provider and accessed through the internet such as Gmail and Office 365. MyRepo falls into this category.

**2- Platform As A Service (PAAS),** where the providers offered a ready environment for development, testing, managing software applications, and delivery. The developers in this model are concerned with the application while the provider is responsible for the management environment and ensuring the correct deployment of services such as Google App Engine.

**3- Infrastructure As a Service (IAAS),** where the providers rent the entire infrastructure in the form of servers or virtual machines, storage, operating systems, etc. Such as Microsoft Azure.

\-

MyRepo is a Software As A Service (SAAS) web storage application that allows users to upload and access their private storage using the cloud subscription model. The service is built from scratch using local resources – there are no third-party resources nor COTS components used in this implementation, the whole service is open-source in order to achieve the trust of our future clients and ensure them the privacy they will have by choosing our unique “server-knows-nothing” model.

In the upcoming pages, we will dive into our cloud’s design, implementation, and compare it to existing competitors and show its advantages that could make MyRepo excel in the cloud storage field.
## <a name="_toc107323738"></a>Problem Definition

Over the previous decades, our dependence on computers has massively increased, and with that, our need to store our data has also increased. 

For some people, their entire life’s work and memories are stored on these bits and bytes. In addition, we find ourselves wanting to access these data from different locations and/or devices, and we don’t want to be physically bound to one device in order to access these data.

As for the elephant in the room, ransomware and blackmailing have become a usual practice in the modern world. While it is criminalized in every country in the world, it is very easy to commit this cybercrime and hide without being detected using advanced tools. What makes this worse is the fact that this type of crimes is often done on an international scale, even if you know the person who committed a cybercrime against you, you have nothing to do against it unless this is a national-level crime.

It only takes a few minutes for an experienced black-hat hacker to access our most sensitive data and encrypt them and lock us from these data forever unless payment is paid if the user if not careful with what he/she installs on their computer. This is very common, especially with inexperienced users with computers, the chances of them getting exposed to ransomware are not slim, hence making their data easy prey for hackers. 

We have been discussing the problem of ransomware and blackmailing from the user’s reckless side only, but even if the user is very careful, the data breach could even happen from the cloud services they are using. In fact, last year -2021- has been a record year of the highest number of data breaches in history with 1,862 data breaches as per CNN. Such attacks are coordinated on a national scale and they can get impossible to defend against.

\-

Our Service provides a solution for the mentioned problems;

1- Internet access to data over the internet using any device from the user’s account.

2- On-demand storage that can be upgraded anytime per user’s needs.

3- Enhanced security measures. The cloud storage providers are always responsible for securing their clients’ data and that is what we will be doing, we are also taking this a step further with our “server-knows-nothing” feature. That is, no one (even server administrators), can recognize the data uploaded to the drive because it is encrypted using AES, the so-far-unbreakable encryption algorithm, with the user’s key – and the keys are not stored in our database. Even in the event of a data breach, the data that hackers supposedly accessed have no value as they don’t have users’ keys used in encryption. It is computationally impossible to break the AES algorithm, so our solution in the worst-case scenario is still secure and safe from data breaches.
## <a name="_toc107323739"></a>Objective of the Project

**Short-term objective**

Providing self-sufficiency of cloud storage needs using unutilized available hardware. A fully developed website should be developed to act as a portal to our service, as well as a configured server that does the job of actually storing the data. The goals of this stage are:

- Implementing the “server-knows-nothing” concept, where all the files that the user uploads into the cloud are encrypted using a unique key known only to user. Even though the files are physically on the server, their content is unknown to the server. This feature gives users more security and privacy in the event of data leakage or the existence of malicious insiders.
- Adding compressing feature to the cloud. That is, when a user uploads a file, it automatically gets compressed, and by doing so the file size will shrink. This feature will give the users better utilization of their storage. 
- Configuring the communication line protocols and measures between the server and the website.
- Ensuring that the connection is secure and encrypted, and the files are transported safely.
- Creating an automated replication system to restore files in the event of server failure (Beta).
- Implementing a strong backend that stores the users’ analytical data and enables them to perform certain filtering commands to their cloud service.
- Implementing a responsive front-end that is accessible from all devices and uses a minimalist design that appeals to all users regardless of their technicality level.

**Long-term objective**

Expanding the goals achieved in the short term to support a large number of users. The targeted users would be those living in the geographical proximity of Egypt (i.e., The Middle East). Thus, the operation cost is expected to be competitive as we will be operating from Egypt compared to Google Drive or Amazon Cloud Services, while not sacrificing the bandwidth speed of the communication between the servers and the users, based on the fact that bandwidth degrades the longer the distance is between the server and the client. Current similar systems provide plain storage services without any smart storage facilities to users. Therefore, our Smart Storage as a Service will offer a new advanced experience of cloud storage. 
# <a name="_toc107323740"></a>**Chapter 2: Related Systems** 
**1. Google Drive**

Google Drive is the most popular storage cloud in the world, provided by the world’s tech-leader corporation, Google.

`	`Advantages:

- Free 15 GBs of storage.
- User-friendly interface that is accessible from all devices.
- Allows file sharing.
- Quick preview of files such as PDFs, videos, images, etc.
- Flexible and cheaper plans.

`	`Disadvantages:

- No file encryption: Google uses SSL encryption, so the users’ communication with google drive is encrypted. However, the files itself that reside inside Google’s servers are not encrypted. We can verify this fact from their preview feature, you can preview a PDF (for example) from the browser without downloading the file. This indicated that the file is stored in its plain format.
- Google analyzes users’ content: As per [Google’s policy](https://policies.google.com/terms), Google is periodically analyzing its users’ content and collecting information about the user in order to use this information later in ads.

**2. DropBox**

Dropbox is a file hosting service operated by the American company Dropbox, that offers cloud storage, file synchronization, personal cloud, and client software.

`	`Advantages:

- Faster Performance.
- Free 2 GB of storage.
- User-friendly interface that is accessible from all devices.
- Allows file sharing.

`	`Disadvantages:

- No file encryption, just like Google Drive.
- More expensive plans.



**3.** **Amazon S3 (Part of AWS)**

S3 service provided by AWS (Amazon Web Services) that offers storage through a cloud portal. The storage can be used to store any type of object, allowing storing Internet applications, backups, recovery, disaster recovery, hybrid cloud storage, and others.

`	`Advantages:

- Suitable plans for medium and large businesses.
- High-security measures.

`	`Disadvantages:

- Not designed for individual use


**The uniqueness of MyRepo system**

After having a view of other solutions out there, we can confirm that they all offer a friendly user interface that is accessible from all devices, free storage, basic security measures, and file-sharing functionality.

MyRepo will be offering the common features found at competitors:

- Free 1 GB of storage\*.
- User-Friendly interface that is accessible from all devices and platforms.
- File sharing functionality with a common group encryption key.

MyRepo will also offer new features that are not available at the other competitors as:

- Server-knows-nothing encryption technique that achieves high security and privacy goals.
- No data collection about users’ files will be performed.
- File compression upon uploading, which will save the users extra space and allows better utilization of their current plan.
- Higher resistibility against data leakages due to using AES for encryption/decryption algorithm which is computationally unbreakable.

\* The current version of MyRepo is limited in terms of storage, so the service cannot sustain larger free storage than 1 GB for free users. However, this number is likely to increase if the project gets funded (so that total storage can be upgraded) and released to the public.
# <a name="_toc107323741"></a>**Chapter 3: MyRepo Design**

We have previously discussed the objectives that MyRepo tries to achieve. In the upcoming sections, we will be discussing how MyRepo is built and the theory of its operation. Our design focuses on throwing as much work on the client-side than the server-side’s. One reason for that is to -of course- lessen the load on the server, but the most important reason is the fact that this achieves our privacy goals. We want the server to know nothing about the data it holds. We are taking advantage of the fact that modern computers are capable and can make serious processing on their end rather than leaving the heavy-duty for the usually powerful servers. Such application might have not been possible a decade or two ago (or at least it would have been exclusive for powerful computers only), but as of 2022, we don’t expect that there will be a device struggling to perform AES encryption -for example- from the front-end.

Shown in the figure below is a use-case diagram for the system:

![](images/images/Aspose.Words.e765f280-7fcf-45ac-a826-6d1711082731.003.jpeg)*Figure 1: Use Case Diagram*

![](images/images/Aspose.Words.e765f280-7fcf-45ac-a826-6d1711082731.002.png)



Shown in the figure below is the sequence diagram for the upload and download and delete functionalities:

![](images/images/Aspose.Words.e765f280-7fcf-45ac-a826-6d1711082731.005.jpeg)*Figure 2: Sequence Diagram*

![](images/images/Aspose.Words.e765f280-7fcf-45ac-a826-6d1711082731.004.png)



![Graphical user interface

Description automatically generated](images/images/Aspose.Words.e765f280-7fcf-45ac-a826-6d1711082731.006.png)

`				`*Figure 3: Login/Upload Sequence Diagram*
















![Graphical user interface

Description automatically generated](images/images/Aspose.Words.e765f280-7fcf-45ac-a826-6d1711082731.007.png)

`				`*Figure 4: Login/Download, Delete Sequence Diagram*






Shown in the figure below is the flow-chart diagram for the upload and download functionalities:

![](images/images/Aspose.Words.e765f280-7fcf-45ac-a826-6d1711082731.009.jpeg)*Figure 5: Flow-Chart Diagram*

![](images/images/Aspose.Words.e765f280-7fcf-45ac-a826-6d1711082731.008.png)

Shown in the figure below is the Class diagram showing all classes in system and its communication:

![A picture containing timeline

Description automatically generated](images/images/Aspose.Words.e765f280-7fcf-45ac-a826-6d1711082731.010.png)

`				     `*Figure 6: Class Diagram*




Shown in the figure below is the Activity diagram showing series of actions of how users flow through system:

![Diagram

Description automatically generated](images/images/Aspose.Words.e765f280-7fcf-45ac-a826-6d1711082731.011.png)

*Figure 7: Activity Diagram*





MyRepo Operation is divided into three sections:

**I- Server:** This is where the cloud and users’ data are hosted, as well as the database for users’ login information.

**II- Back-End:** This is where the login, registration, database, and user sessions are handled.

**III- Front-End:** This is where the user interacts with the available cloud services (login – register – download – upload, etc). This is also where the encryption and decryption process takes place. This is a key feature in our application that encryption and decryption must happen from the client-side to abide by the “server-knows-nothing” policy, further details on this point will be discussed in the front-end section.

In the upcoming pages, we will discuss each part extensively.


# <a name="_toc107323742"></a>**Chapter 4: SERVER**

## <a name="_toc107323743"></a>Server Hardware Details:

`	`Model Name: MacBook Pro 2012.

`	`CPU: Intel i5-3210M (2.5GHz dual-core).

`	`Memory: 8 GBs of DDR3 1600 MHz.

`	`Available Storage: 80 GBs.

`	`Operating System: Linux Manjaro (Arch-based distro).

## <a name="_toc107323744"></a>Server Configuration

**Step 1: Choosing and setting up the Operating System**

Choosing the correct OS to run the server will save us dozens of hours of work and provide more features to be applied on the server in addition to ease of development. While theoretically Mac OS (the natural OS that comes with our particular server), or even Windows (10, 11, or windows server) can be used for servers, it would be a poor choice, because these operating systems are not designed to function as servers. In addition to complexity, windows falls behind in terms of stability, multiprocessing,  security, community support, and licensing fees (Linux is free while windows requires a license for server usage). While Mac OS is inherently-limited OS that gives (even for average users) limited control over the system.

The clear and obvious choice was Linux. In fact, this is a no-brainer for most server developers all over the world as Linux operates 80% of the world’s servers as of 2022. But another question emerges now, which Linux distribution should we use?

There are dozens of Linux distributions out there. They are all Linux after all, but each distro focuses on a certain side of operation more than the other. Some distros are developed mainly for ease of use, other distros are designed for gaming, others for development, and so on. 

Ideally, a distribution like Red Hat Enterprise, SUSE, Fedora, or even vanilla Debian is perfect for server usage, but we choose to use Manjaro Linux, which is not a server-specific distro, it’s an all-purpose distro. While this is not the most optimal choice, this will not in any way affect the performance of our current cloud as it’s targeted at a minor number of users. In addition, there’s an argument to be made that arch-based distros (a category where Manjaro falls under) are good for server usage provided that you give it more attention, but we mainly choose it because of our familiarity with its packet manager “Pacman” over the Debian-based’s “apt”, and of course because it is free. 

Linux is generally free to use with the exception of the enterprise distros that are used for servers (like SUSE), our case falls under that exception.

The final conclusion is, Linux offers much more support, security, and flexibility in terms of low-level development than Windows (or Mac), so that’s why we choose it. Regarding the Linux distribution choice, it is irrelevant at this stage of development, but if we are serving dozens of thousands of users, this decision will need to be revisited as Red Hat Enterprise or SUSE will be more effective, though this will add more costs to the project as these options are not free.

**Step 2: Initializing the server**

In this step, we will set up our server in order to be able to convert it from a normal piece of hardware to a cloud server that is secure and accessible. We need to install the following packages:

\- Apache Server: to set up a localhost server.

\- PHP.

\- MySQL.

\- UFW: a firewall to allow and block incoming connections on certain ports. We will need this for security and access reasons which will be discussed later.

\- net-tools: a package that lists information about networking, like the famous “ipconfig”.

\- OpenSSH: a protocol that allows remote connections to our server.

After installing these packages and running the Apache server, our server should be working now. The web folder that will hold our users’ data is located at /var/www

We can find the public IP that we will use to access the cloud via this command:

**curl -s icanhazip.com**

Result: *197.37.182.179*

*Note: This is the public address of the router. The private address of the server itself is 192.168.1.239.*

However, if we enter this public IP address in the browser, it will not load anything, that’s because port forwarding is not activated now. To activate port forwarding, we need to go to the router’s page and allow incoming connections on port 23441 (a random number we chose for this project).

As seen in figure (1), we opened the connections incoming to *192.168.1.239* on port 23441.

We also want the firewall on our server to accept the incoming connections on that port. This is done with the help of UFW package that we installed earlier.

**sudo ufw allow 23441**

Now, the incoming connections to our servers will not be blocked by the firewall

![](images/images/Aspose.Words.e765f280-7fcf-45ac-a826-6d1711082731.013.png)*Figure 3: Port Forwarding Settings*
![](images/images/Aspose.Words.e765f280-7fcf-45ac-a826-6d1711082731.012.png)

In the final steps of the setup, we need to create a python server that listens to incoming connections of port 23441 and serves a webpage for anyone that visits our website. We will use a dummy page for the time being. This is our server code (myrepo\_server.py):    

import http.server

import socketserver

class MyHttpRequestHandler(http.server.SimpleHTTPRequestHandler):

def do\_GET(self):

`	`if self.path == '/':

`		`self.path = 'home/ahmed/index.html' 

`	`return http.server.SimpleHTTPRequestHandler.do\_GET(self)

\# Create an object of the above class

handler\_object = MyHttpRequestHandler

PORT = 23441

my\_server = socketserver.TCPServer(("", PORT), handler\_object)

\# Star the server

my\_server.serve\_forever()



Finally, we need to execute the code and keep it running:

**python3 -m myrepo\_server.py**

Our server is now ready. The only problem is, that we haven’t configured DNS yet, so if anyone wants to visit it will have to type into the URL “<http://192.168.1.239:23441/>”, which is not a pretty link for any user.

As we are in the development phase, we will not purchase a Domain name to bind it with our website. However, we are going to use [ngrok.com](http://ngrok.io/)’s free DNS, which will suit our purposes for now. 

This is our temporary domain for testing (this domain will change by the time of release): http://bc97-197-37-182-179.ngrok.io/

![](images/images/Aspose.Words.e765f280-7fcf-45ac-a826-6d1711082731.014.png)

Our demo website is working as expected.

**Step 3 (Extra): Remote Interaction with The Server**

We want to be able to work (as administrators, not users) with the server and access it remotely. This will be helpful in the long-term maintenance and convenience of work. In fact, for our particular server, this step is a must because the laptop’s monitor is broken, so accessing the server from other computers removes a layer of difficulty. But for the most important part, this will help us respond to any error that occurs on the server quickly without the need to be physically next to the server, and make the error recovery unnoticeable.

**a. Configure WOL (Wake-On-Lan)**

WOL command will allow us to wake up the server remotely if it was in sleep mode in order to access it. This feature works by sending a special packet to the physical NIC that wakes up the device. We first ensured whether the server’s physical NIC supports WOL feature or not by running this command:

**sudo ethtool enp0s20u1 | grep Wake-on**

Note: enp0s20u1 is the ID of the server’s NIC. This is obtained by the command “**ip link”**.

![](images/images/Aspose.Words.e765f280-7fcf-45ac-a826-6d1711082731.015.png)

We can confirm WOL is supported as shown, we can proceed to enable it by the following command:

**sudo ethtool enp0s20u1 wol g**

We can now wake the server from anywhere on the local network by running this command:

**wol  B0:A7:B9:6A:71:F2**

Where *B0:A7:B9:6A:71:F2* is the MAC address of the NIC, which is also obtained by the command “**ip link”**.

If we want to allow WOL to work across the internet, we will need to open a port first in the router, say port 24421, then run the following command:

**ip neighbor add 197.37.182.179 lladdr B0:A7:B9:6A:71:F2 dev enp0s20u1**

Now we can wake up the server anywhere across the internet using the following command:

**wol -p 24421 -i 197.37.182.179  B0:A7:B9:6A:71:F2**

**b. Configure SSH (Secure Shell)**

SSH is a protocol that allows us to connect with a computer using a command-line interface and execute commands on the target machines, this is usually used in servers. The OpenSSH protocol is installed as earlier mentioned in the required packages section.

To start the SSH on the server-side, apply the following command:

**sudo systemctl start sshd**

Now, SSH should be running, and the server can receive connections. By default, OpenSSH runs on port 22. I have changed this port to 24115 (for security reasons) in the ssh config file. We already know the IP address of the server, so we will use this command to connect to the server:

**ssh -p 24415 ahmed@192.168.1.239**

The connection is established now, and we can execute remote commands to our server as shown in the figure below. The figure shows my computer (192.168.1.6) is connecting -using the terminal- to the server and executing the command “whoami” on the server.

![](images/images/Aspose.Words.e765f280-7fcf-45ac-a826-6d1711082731.016.png)

We can notice that SSH doesn’t simply allow any connection incoming on that IP and port, we have to enter the credentials of the server in order to have access to the desktop.

Note: 192.168.1.239 is the server’s local IP address. SSH will work normally across the internet using the public IP (197.37.182.179), but we will need to allow port forwarding (on port 24415) first. Similar to what WOL required to allow internet connections.

**c. Configure RDP (Remote Desktop Protocol)**

We have established SSH and it’s working as expected. However, SSH only allows interactions between computers using commands (using CLI or Command Line Interface). In our case, this is perfect, but we want to take this one step further and have a GUI remote interaction.

RDP has various implementations out there; we are going to use NoMachine software and its NX technology (an application of RDP). We chose NoMachine for its security options, ease of use, file transfer, and improved performance.

Shown below is NoMachine running on our server

![](images/images/Aspose.Words.e765f280-7fcf-45ac-a826-6d1711082731.017.png)

And the below figure shows that NoMachine will listen on port 3999 for incoming connections:

![](images/images/Aspose.Words.e765f280-7fcf-45ac-a826-6d1711082731.018.png)

Note: Same as SSH, the protocol doesn’t simply allow any connection incoming on that IP and port, we have to enter the credentials of the server in order to have access to the desktop.

This software also has many security and performance options, but we will not deep dive into them in this document. If you are interested in the details of NoMachine and NX, please refer to [nomachine.com](https://www.nomachine.com/).


To connect from any device, we will need to install NoMachine Client first and add the server’s IP (same step as SSH). As seen in the figure below, my NoMachine client added my server and is ready to connect to it.

![](images/images/Aspose.Words.e765f280-7fcf-45ac-a826-6d1711082731.019.png)

To connect, I have to enter the credentials of the server.

![](images/images/Aspose.Words.e765f280-7fcf-45ac-a826-6d1711082731.020.png)

Finally, here is a look at how the connection currently looks from my workstation:

![](images/images/Aspose.Words.e765f280-7fcf-45ac-a826-6d1711082731.021.png)

**Step 4: Setting up the file storage system**

We want to design a storage system that will handle users' uploads and downloads in an organized manner.

![](images/images/Aspose.Words.e765f280-7fcf-45ac-a826-6d1711082731.023.jpeg)*Figure 8: Storage File System*

![](images/images/Aspose.Words.e765f280-7fcf-45ac-a826-6d1711082731.022.png)

Shown in figure 2 is the design of our cloud storage system, where all the files reside in /srv/http/. In that directory, we have the website files that the server will serve to every visitor to the website (like index.html, style.css, script.js.. etc.), and we have a directory for each user in the system, where their uploads will be stored in, and where they will be able to download their data from. 

Note: All the files are encrypted from the client-side, the server does not know what are these files. The server can tell which file belongs to which user based on the directory that the file resides in, and also using the naming convention that we will discuss next.

**The Naming Convention**

All users have a unique ID, so the file name will come as the following formula:

**file\_{user\_id}{unique\_random\_number}**

Where *user\_id* is a 4-digit number, and the random number is 16 digits and it does not repeat throughout the server

Shown below is an abstracted diagram of the storage system, where the server gets users' requests to view their data (through the front-end), then retrieves the files from the database and shows them to the meant user

![](images/images/Aspose.Words.e765f280-7fcf-45ac-a826-6d1711082731.025.jpeg)*Figure 9: Abstract view of file retrieval*

`	`![](images/images/Aspose.Words.e765f280-7fcf-45ac-a826-6d1711082731.024.png)

![](images/images/Aspose.Words.e765f280-7fcf-45ac-a826-6d1711082731.027.jpeg)*Figure 10: Abstract view of server and front-end operation*
![](images/images/Aspose.Words.e765f280-7fcf-45ac-a826-6d1711082731.026.png)



**Step 5: Setting up PHP Server**

To set up the PHP server, we need the LAMP Stack. LAMP is Linux, Apache HTTP server, MySQL DB management, and PHP package, it generally bundles all the packages we need to set up the server.

After installing Apache, We will head to “*/etc/httpd/conf/httpd.conf*” and add our hostname so that we can access the server using our local host. We will add the following line in the conf file:

**127.0.0.1 localhost.localdomain localhost majarer**

Now we can view the index page of Apache, this index page is located at “*/srv/http/index.html*”, and this is the location where our website will be located.

![](images/images/Aspose.Words.e765f280-7fcf-45ac-a826-6d1711082731.028.png)

Also at this step MySQL was installed and initialized. Our database is not ready yet so we will refer to its documentation later in this document.

Finally, PHP and PHP-Apache packages were installed and configured. Now our LAMP stack is successfully installed. To test it, we can create “info.php” file that will give us the installed PHP info:

**<?php phpinfo(); ?>**

![](images/images/Aspose.Words.e765f280-7fcf-45ac-a826-6d1711082731.029.png)

**Enabling Uploading Feature**

So far, our server allows users to download files but it doesn’t allow uploads. This is what we are concerned with achieving in this section. Unlike the usual way of making the upload functionality via PHP, we are going to implement it using JavaScript. The reason behind this is the fact that we want to encrypt the files first on the client side before sending them to the server. We will get to the encryption part later, but for now, the upload functionality is done using JavaScript on the client-side, and a PHP handler to receive the file on the server-side

![](images/images/Aspose.Words.e765f280-7fcf-45ac-a826-6d1711082731.030.png)

we will add the uploading functionality in our index.php as well as upload.php:

***Client-Side:***

<input id="fileupload" type="file" name="fileupload" /> 

<button id="upload-button" onclick="uploadFile()"> Upload </button>

<script>

`	`async function uploadFile() {

`		`let formData = new FormData(); 

`		`formData.append("file", fileupload.files[0]);

`		`await fetch('/upload-form.php', {

`			`method: "POST", 

`		`body: formData

`		`}); 	

`		`alert('The file has been uploaded successfully.');

`	`}

</script>

***Server-Side (upload-form.php):***

<?php

`	`/\* Enable error reporting for debugging \*/

`	`error\_reporting(E\_ALL);

`	`ini\_set("display\_errors", 1);

`	`/\* Get the name of the uploaded file \*/

`	`$filename = $\_FILES['file']['name'];

`	`/\* Choose where to save the uploaded file \*/

`	`$location = "/srv/http/uploads/".$filename;

`	`/\* Save the uploaded file to the local filesystem \*/

`	`if ( move\_uploaded\_file($\_FILES['file']['tmp\_name'], $location) | true) { 

`		`echo 'Upload Success';

`		`// compression:

`		`$zip = new ZipArchive;

`		`if ($zip->open('uploads/test\_new.zip', ZipArchive::CREATE) === TRUE)

`		`{

`			`// Add files to the zip file

`			`$zip->addFile($location ,basename('blob'));



`			`// All files are added, so close the zip file.

`			`$zip->close();



`			`// Remove the uncompressed file - To save space

`			`unlink($location);

`		`}

`		`echo 'Compression Success';



`		`} else { 

`			`echo 'Compression Failure';

`	`}


\>



Now the uploading functionality is working. If we try to upload a file, it will get added to the “*uploads/*” directory.

![](images/images/Aspose.Words.e765f280-7fcf-45ac-a826-6d1711082731.031.png)

Click “*Send File*”

![](images/images/Aspose.Words.e765f280-7fcf-45ac-a826-6d1711082731.032.png)

The code is now primitive, but it is a proof of concept. Our final code will have more complicated logic, and the full code will be uploaded to the GitHub Repository.



**Step 6: Setting up Domain Name Service (DNS)**

Our domain name right now (<https://41.44.91.175/>) is not looking pretty at all. Computers -in networking- only understand numbers, not words. So, we can’t just say “visit [www.myrepo.online](http://www.myrepo.online/)” and expect it to work immediately. And of course, no one will remember these random number everytime they want to visit our website, we have to make it easier for the visitors to access our service. On top of that, our public IP is even not static, our ISP periodically changes it, so there has to be a way to dynamically bind the service with the server. This is where DNS comes handy to use. We have to bind the public IP of our server to a domain name. 

Domain names are available to purchase as per ICANN (The Internet Corporation for Assigned Names and Numbers) license via different vendors around the world. 

We choose [NameCheap](https://www.namecheap.com/) provider to purchase our domain name “myrepo.online” as well as a SSL certificate for this website (more on the SSL certificate in the upcoming sections).

![](images/images/Aspose.Words.e765f280-7fcf-45ac-a826-6d1711082731.033.png)

In the figure above is our IP-Domain binding. Every entry to “[https://www.myrepo.online](https://www.myrepo.online/)” will be forwarded to our server’s public IP “41.44.91.175”, as well as a verification for the SSL in the “CNAME Record”. Any changes to this public IP takes few minutes to update globally.

Now we have it! Anyone in the world can type “myrepo.online” in their browsers and access our service.

**Step 7: Setting up SSL Certifcates (Secure Sockets Layer)**

So far, our traffic was done via HTTP. This application layer protocol communicates data between client and servers in an plain, unencrypted format. So, if there was an attacker sniffing the traffic between the client and the server, he/she will be able to capture the data being transmitted. 

We do our encryption on the client-side, so even if an attacker captured the traffic, it would still impose infeasible effort to decrypt it. However, sensitive data like the username and the password credentials will be captured via HTTP easily. While still if an attacker hacked the user’s cedentials, the data on the cloud are still only accessible if and only if the encryption key is available, but we still want to provide more security to our users, so we need to use HTTPS instead of HTTP. The difference between the two protocols is that HTTPS encrypts the traffic from the client using the public key of our server, and applying RSA algorithm on that traffic. If an attacker captured the traffic at this point, it will be encrypted and only accessible if the attacker has the private key of the server. When the traffic reaches the server, it gets decrypted via the server’s private key.

But how do we get a public and private key for our server that can be used by browsers to encrypt traffic? This is where we need and SSL Certificates.

These certificates are issued by aCertificate Authority (CA). the CA is the trustworthy third party that will authenticate both ends of the transaction. An SSL certificate binds together a domain name, hostname, and server name along with the organizational identity and location.

In our server, we purchased the certificate from [PositiveSSL](https://www.positivessl.com/) CA via NameCheap.

![](images/images/Aspose.Words.e765f280-7fcf-45ac-a826-6d1711082731.034.png)

We can see in NameCheap’s control panel that the certificate is issued for our domain “<https://www.myrepo.online/>” and it is valid for 1 year

![](images/images/Aspose.Words.e765f280-7fcf-45ac-a826-6d1711082731.035.png)

Here is the details about our server’s public key:

![](images/images/Aspose.Words.e765f280-7fcf-45ac-a826-6d1711082731.036.png)

And of course we were provided by a private key in order to decrypt the traffic encrypted by the above public key.

We can see that this certificate is only available to MyRepo and cannot be redirected to another website.

![](images/images/Aspose.Words.e765f280-7fcf-45ac-a826-6d1711082731.037.png)



Final step is to install these certificates on the server in order to enable them.

We first need to enable the Apache’s ssl\_module to make use of the certificates. As shown below, the module is already activated.

![](images/images/Aspose.Words.e765f280-7fcf-45ac-a826-6d1711082731.038.png)

Then we will add the path of our downloaded certificates (obtained from NameCheap), and instruct ssl\_module in Apache to use them.

![](images/images/Aspose.Words.e765f280-7fcf-45ac-a826-6d1711082731.039.png)

All we have to do now is to restart Apache server using the following command:

***sudo service httpd restart***

After that, the server will be listening to traffic incoming on port **443** (HTTPS official port number), and when traffic comes to this port, it will decrypt it and forward to myrepo.

![](images/images/Aspose.Words.e765f280-7fcf-45ac-a826-6d1711082731.040.png)

To verify everything is working as expected, we can visit <https://www.myrepo.online/> and check if the browser accepts the HTTPS connection. As shown in the figure below, the browser successfully accepts the secure HTTPS connection and verifies that the certificate is valid to use.

![](images/images/Aspose.Words.e765f280-7fcf-45ac-a826-6d1711082731.041.png)

We can also click on the certificate to see further more details about it:

![](images/images/Aspose.Words.e765f280-7fcf-45ac-a826-6d1711082731.042.png)

Extra Details on the certificate:

![](images/images/Aspose.Words.e765f280-7fcf-45ac-a826-6d1711082731.043.png)



**Step 8: Setting up Automated Backup System**

Backup and replication is crucial to every cloud service provider. In this section, we will implement an automatic backup logic that will periodically take a copy of our users’ encrypted data as well as the database, and save them on an external device.

Due to the lack of resources, this external hard drive will be one of our member’s personal drive and the backup will take place every 72 hours. 

In an optimal scenario, these data should be backed up to separate drives (not only one), they should be only used for backups and nothing else, and finally, they should not exist in the same location as if there was a disaster not all of them will get affected. But for the time being, the secondary PC will do the job. Later down the line, we can easily modify the path of the backup when the resources are available by changing few characters in the commands.

**Step A: Set Up SFTP Connection With The Backup Computer**

Backup files will be sent over the network using SFTP (Secure File Transfer Protocol). This is a protocol used specifically for file transfers, and it’s an improvement over its predecessor FTP, as it encrypts the traffic before sending it on the wire.

FTP and SFTP are installed by default on Linux machines, which is the OS for both the server and the backup computer.

What will be is requires is:

1- Enable port 22 on the backup machine. Port 22 is the reserved port for the SFTP protcol, and it has to be opened first to accept incoming traffic. This can be done by the following command:

***sudo ufw allow 22***

Port 22 is now allowed.

![](images/images/Aspose.Words.e765f280-7fcf-45ac-a826-6d1711082731.044.png)

2- Obtain credentials on the backup machine. The credentials are the host IP, username, and password of the backup user.

In my case, the host was “*192.168.1.6*”, and the username is “*ahmed*”. The password was typed as well but linux terminal hides passwords by default.

![](images/images/Aspose.Words.e765f280-7fcf-45ac-a826-6d1711082731.045.png)

We can now test the connection by transferring a test file. As we can see, it has been successfully transferred.

![](images/images/Aspose.Words.e765f280-7fcf-45ac-a826-6d1711082731.046.png)

**Step B: Develop A Backup Script**

The target script will need to do the following:

1- Backup the user uploads’ directories. This is found in /srv/http/uploads/

2- Backup the database. This is done using the help of mysqldump command.

3- Zip (1) and (2), under the name of the backup date (e.g. myrepo\_backup\_10\_sept\_2022.zip).

4- Transfer the backup file to the backup device using SFTP command.

5- Repeat the previous commands automatically every 72 hours.

This is the content of the main script *backup-shell.sh*:

![](images/images/Aspose.Words.e765f280-7fcf-45ac-a826-6d1711082731.047.png)

*backup-shell.sh* calls the SFTP script to perform the copy automatically without terminal interaction for entering the password:

![](images/images/Aspose.Words.e765f280-7fcf-45ac-a826-6d1711082731.048.png)

Our script successfully backs up the data! All what is left now is to let this process repeat automatically. To do this, we will use the Linux’s built in command “*crontab*”.

The following command will call the shell script every 3 days. This is done by typing this command in the *crontab* config file in */etc/crontab*.

![](images/images/Aspose.Words.e765f280-7fcf-45ac-a826-6d1711082731.049.png)

Everything is working as expected now! Here is the result of the backup of 10<sup>th</sup> of september 2022.

![](images/images/Aspose.Words.e765f280-7fcf-45ac-a826-6d1711082731.050.png)
# <a name="_toc107323745"></a>**Chapter 5: BACK-END**

## <a name="_toc107323746"></a>Languages used
- PHP
- Mysql

## <a name="_toc107323747"></a>Structure
`	`System consists of 4 php files and database of 2 tables.

4 PHP files:

- Database Connection
- Login
- Register
- Delete File
- Password Reset
- Share Link
- Shared File Details
- Domain Link

2 Tables in Database:

- Users table.
- File table.

## <a name="_toc107323748"></a>Database
`	`MyRepo consist of 2 main table that contain users’ info and data info 

Which are:

- Users Table.
- File Table.

Those 2 tables are the backbone of our Cloud server. 

Database was create using Xampp.

In the following pages each table will be explained in detail and how classes communicate and how the 2 table send and receive data from each other 

And class diagrams and Entities diagrams, ER diagrams, Relations diagrams …etc.

### <a name="_toc107323749"></a>ER Diagram
`	`The shown diagram explains visualizes relation between the 2 entity [ Users,Files] illustrating the database structure

![](images/images/Aspose.Words.e765f280-7fcf-45ac-a826-6d1711082731.051.png)

`					`Figure 11: ER diagram













# <a name="_toc107323750"></a>**Chapter 6: FRONT-END**
`	`Simple friendly interface created for user to navigate easily without any difficulties.

There is 3 pages:

- Home page
- Login page
- Registration 

## <a name="_toc107323751"></a>Login Page
`	`![Graphical user interface, application

Description automatically generated](images/images/Aspose.Words.e765f280-7fcf-45ac-a826-6d1711082731.052.png)

Simple Login panel where user enter his username and password to enter home page







## <a name="_toc107323752"></a>Register Page
`	`For new users to sign up to our system , user go to register

![Graphical user interface, text, application

Description automatically generated](images/images/Aspose.Words.e765f280-7fcf-45ac-a826-6d1711082731.053.png)













## <a name="_toc107323753"></a>Diagram
`	`Following diagram explain an abstract view of how front end communicate with server and how encryption and decryption works

## <a name="_toc107323754"></a>Encryption and Decryption Diagram
![](images/images/Aspose.Words.e765f280-7fcf-45ac-a826-6d1711082731.027.jpeg)*Figure 12: Abstract view of front-end encryption and decryption*
![](images/images/Aspose.Words.e765f280-7fcf-45ac-a826-6d1711082731.054.png)

![](images/images/Aspose.Words.e765f280-7fcf-45ac-a826-6d1711082731.056.jpeg)*Figure 13: Encryption-Decryption Process*

![](images/images/Aspose.Words.e765f280-7fcf-45ac-a826-6d1711082731.055.png)





# <a name="_toc107323755"></a>Implementation
`	`The Following part contain System codes Server, Backend, Front end

## <a name="_toc107323756"></a>DB\_Connection
`	`This file is used to check that a communication is established with the database

Code:

<?php

$servername = "localhost";

$username = "root";

$pass = "";

$dbname= "myrepo";

$conn = **mysqli\_connect**($servername, $username, $pass, $dbname);

// Check connection

**if** (!$conn) {

`  `**die**("Connection failed: " . **mysqli\_connect\_error**());

}

/\* $query="INSERT INTO users (Name,Email,Password)

` `VALUES ('marc','marcosda@gmail','1234')";

` `if(mysqli\_query($conn,$query)){

`	 `echo "added successfully";

` `}

` `mysqli\_close($conn); \*/

?>
## <a name="_toc107323757"></a>Login
` 	`Login file is taking Username and password from user and check it with the database and if correct sign-in happens else it asks him to re-enter data

Code:

<?php

**session\_start**();

**include**("DB\_connection.php");

//make sure that something is been sent

**if**($\_SERVER['REQUEST\_METHOD']== "POST"){



`	`$user\_name=$\_POST['username'];

`	`$pass=$\_POST['password'];



`	`**if**(!**empty**($user\_name)&&!**empty**($pass)){



`		`// read from data base

`		`$query="SELECT \* FROM users WHERE Name = '**$user\_name**' limit 1";

`		`$output = **mysqli\_query**($conn,$query);

`		`**if**($output){

`			`**if**($output && **mysqli\_num\_rows**($output)>0){

`				`$data=**mysqli\_fetch\_assoc**($output);

`				`**if**($data['Password'] == $pass){

`					`$\_SESSION['userid']= $data['ID'];

`					`**header**("Location: http://localhost/Codes/SAAS\_Cloud/uploadForm.php");

`					`**die**;

`				`}

`			`}	

`		`}

`		`**else**{

`			`**echo** "invalid data1";

`		`}



`	`}

`	`**else**{

`		`**echo** "invalid data";

`		`**header**("Location: http://localhost/Codes/SAAS\_Cloud/loginpage.php");

`		`**die**;

`	`}

}

?>		

## <a name="_toc107323758"></a>Register
`	`This is file where new users are created and added to the database.

It saves his name, email, password, and automatically sign an ID for the user

Code:

<?php

**session\_start**();

**include**("DB\_connection.php");

//make sure that something is been sent

**if**($\_SERVER['REQUEST\_METHOD']== "POST"){



`	`$user\_name=$\_POST['username'];

`	`$pass=$\_POST['password'];

`	`$email=$\_POST['email'];



`	`**if**(!**empty**($user\_name)&&!**empty**($pass)&&!**empty**($email)&&!**is\_numeric**($user\_name)){

`		`$query="insert into users (Name,Email,Password) values ('**$user\_name**','**$email**','**$pass**')";



`		`// save in data base

`		`**mysqli\_query**($conn,$query);

`		`**echo**"saved";

`		`**header**("Location: http://localhost/Codes/SAAS\_Cloud/loginpage.php");

`		`**die**;

`	`}

`	`**else**{

`		`**echo** "invalid data";

`	`}

}

?>
## <a name="_toc107323759"></a>upload-form	
`	`File is upload and being compressed while uploaded

Code:

<?php

**error\_reporting**(**E\_ALL**);

**ini\_set**("display\_errors", 1);

`  `/\* Get the name of the uploaded file \*/

`  `$filename = $\_FILES['file']['name'];

`  `/\* Choose where to save the uploaded file \*/

`  `$location = "/srv/http/uploads/".$filename;

`  `/\* Save the uploaded file to the local filesystem \*/

`    `**if** ( **move\_uploaded\_file**($\_FILES['file']['tmp\_name'], $location) | **true**) { 

`      `//echo 'Upload Success';

`      `// compression:

`      `$zip = **new** ZipArchive;

`      `**if** ($zip->open('uploads/test\_new.zip', ZipArchive::CREATE) === **TRUE**)

`      `{

`          `// Add files to the zip file

`          `$zip->addFile($location ,**basename**('blob'));

`          `//$zip->addFile('test.pdf');

`          `// All files are added, so close the zip file.

`          `$zip->close();

`          `// Remove the uncompressed file - To save space

`          `**unlink**($location);

`      `}



`      `**echo** 'Compression Success';

`  `} **else** { 

`    `//echo 'Upload Failure'; 

`  `}


/\*

if ( move\_uploaded\_file($\_FILES['file']['tmp\_name'], $location) ) { 

`    `$compress\_cmd = "lz4 ".$location;

`    `shell\_exec($compress\_cmd);

`    `$output = shell\_exec('ls -lart');

`    `echo "<pre>$output</pre>";

`    `echo 'Upload Success'; 

`  `} else { 

`    `echo 'Upload Failure'; 

`  `}

`  `-----------------



`      `// $compress\_cmd = "/usr/bin/lz4 ".$location;

`      `//$compress\_cmd = "/usr/bin/lz4 /srv/http/uploads/blob";

`      `$output = [];

`      `$code = 0;

`      `$success = exec('ls -lart', $output, $code);

`      `if ($success === false){ //Error

`      `$response = json\_encode([

`          `'status' => 'failed',

`          `'code' => $code,

`          `'output' => $output,

`      `]);

`      `}

`    `else {

`      `$response = json\_encode([

`          `'status' => 'success',

`          `'code' => $code,

`          `'output' => $output,

`      `]);

`    `}

`    `echo $response;

\*/








## <a name="_toc107323760"></a>Login page
Code:

<!DOCTYPE html>

<html lang=**"en"**>
**
`  `<head>
**
`    `<meta charset=**"UTF-8"** />
**
`    `<title>**Login**</title>
**
`    `<link rel=**"stylesheet"** href=**"style.css"** />
**
`    `<link rel=**"preconnect"** href=**"https://fonts.googleapis.com"** />
**
`    `<link rel=**"preconnect"** href=**"https://fonts.gstatic.com"** crossorigin />
**
`    `<link

`      `href=**"https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500;600;700&display=swap"**

`      `rel=**"stylesheet"**

`    `/>
**
`  `</head>
**
`  `<body>
**
`    `<div class=**"wrapper"**>
**
`      `<div class=**"login-title-box"**>
**
`        `<h2>**Login**</h2>
**
`      `</div>

**      <p class=**"info-p"**>**Please fill in your credentials to login.**</p>
**
`      `<form action=**"Backend/Login.php"** method=**"post"** class=**"login-form"**>
**
`        `<div class=**"form-group"**>
**
`          `<label>**Username**</label>
**
`          `<input

`            `type=**"text"**

`            `name=**"username"**

`            `class=**"form-control "**

`            `placeholder=**"Username ..."**

`            `autofocus

`          `/>
**
`          `<span class=**"invalid-feedback"**></span>
**
`        `</div>
**
`        `<div class=**"form-group"**>
**
`          `<label>**Password**</label>
**
`          `<input

`            `type=**"password"**

`            `name=**"password"**

`            `class=**"form-control "**

`            `placeholder=**"Password ..."**

`          `/>
**
`          `<span class=**"invalid-feedback"**></span>
**
`        `</div>
**
`        `<div class=**"form-group"**>
**
`          `<input type=**"submit"** class=**"btn btn-primary"** value=**"Login"** />
**
`        `</div>
**
`        `<p>**Don't have an account?** <a href=**"signup.php"**>**Sign up now**</a>**.**</p>
**
`      `</form>
**
`    `</div>
**
`  `</body>

</html>

## <a name="_toc107323761"></a>Register Page
Code:

<!DOCTYPE html>

<html lang=**"en"**>
**
`  `<head>
**
`    `<meta charset=**"UTF-8"** />
**
`    `<title>**Sign Up**</title>
**
`    `<link rel=**"stylesheet"** href=**"style.css"** />
**
`    `<link rel=**"preconnect"** href=**"https://fonts.googleapis.com"** />
**
`    `<link rel=**"preconnect"** href=**"https://fonts.gstatic.com"** crossorigin />
**
`    `<link

`      `href=**"https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500;600;700&display=swap"**

`      `rel=**"stylesheet"**

`    `/>
**
`  `</head>
**
`  `<body>
**
`    `<div class=**"wrapper"**>
**
`      `<div class=**"login-title-box"**>
**
`          `<h2>**Sign Up**</h2>
**
`      `</div>
**
`      `<p class=**"info-p"**>**Please fill this form to create an account.**</p>
**
`      `<form action=**"Backend/register.php"** method=**"post"** class=**"login-form"**>
**
`        `<div class=**"form-group"**>
**
`          `<label>**Username**</label>
**
`          `<input

`            `type=**"text"**

`            `name=**"username"**

`            `class=**"form-control** <?php **echo** (!**empty**($username\_err)) ? 'is-invalid' : ''; ?>**"**

`            `value=**""**

`            `placeholder=**"Username ..."**

`            `autofocus

`          `/>
**
`          `<span class=**"invalid-feedback"**></span>
**
`        `</div>
**
`        `<div class=**"form-group"**>
**
`          `<label>**Email**</label>
**
`          `<input

`            `type=**"text"**

`            `name=**"email"**

`            `class=**"form-control** <?php **echo** (!**empty**($email)) ? 'is-invalid' : ''; ?>**"**

`            `value=**""**

`            `placeholder=**"Email ..."**

`          `/>
**
`          `<span class=**"invalid-feedback"**></span>
**
`        `</div>
**
`        `<div class=**"form-group"**>
**
`          `<label>**Password**</label>
**
`          `<input

`            `type=**"password"**

`            `name=**"password"**

`            `class=**"form-control** <?php **echo** (!**empty**($password\_err)) ? 'is-invalid' : ''; ?>**"**

`            `value=**""**

`            `placeholder=**"Password ..."**

`          `/>
**
`          `<span class=**"invalid-feedback"**></span>
**
`        `</div>
**
`        `<div class=**"form-group"**>
**
`          `<label>**Confirm Password**</label>
**
`          `<input

`            `type=**"password"**

`            `name=**"confirm\_password"**

`            `class=**"form-control** <?php **echo** (!**empty**($confirm\_password\_err)) ? 'is-invalid' : ''; ?>**"**

`            `value=**""**

`            `placeholder=**"Confirm Password ..."**

`          `/>
**
`          `<span class=**"invalid-feedback"**></span>
**
`        `</div>
**
`        `<div class=**"form-group"**>
**
`          `<input type=**"submit"** class=**"btn btn-primary"** value=**"Submit"** />
**
`          `<!-- <input type="reset" class="btn btn-secondary ml-2" value="Reset" /> -->
**
`        `</div>
**
`        `<p>**Already have an account?** <a href=**"loginpage.php"**>**Login here**</a>**.**</p>
**
`      `</form>
**
`    `</div>
**
`  `</body>

</html>













## <a name="_toc107323762"></a>Home Page
Code:

<!DOCTYPE html>

<html>

**  <head>

**    <link rel=**"stylesheet"** href=**"style.css"**>
**
`    `<link rel=**"icon"** type=**"image/x-icon"** href=**"/images/favicon.ico"**>
**
`    `<!-- 

`    `<script src="assets/js/aes.js"></script>

`    `<script language="JavaScript"  src="dist/bundle.js"></script>

`    `<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.2/axios.min.js"></script>

`    `<script type="text/javascript" src="https://cdn.rawgit.com/ricmoo/aes-js/e27b99df/index.js"></script>

`    `<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.9-1/crypto-js.js"></script>

`    `<script src="http://localhost:3002/require-browser.js"></script>

`    `<script language="JavaScript"  src="./support.js"></script> 

`    `-->

**    <title>**MyRepo**</title>
**
`  `</head>

<body>
**
`  `<?php 

`  `**error\_reporting**(**E\_ALL**);

`  `**ini\_set**("display\_errors", 1);

`  `?>


**  <h1>**Welcome to MyRepo!**</h1>
**
`  `<p>**Our cloud is still under development. Please try again at a later time :)**</p>
**
`  `<p>**Regards from Ahmed, Marco and Maomen.**</p>
**
`  `<p>**Here is a test file:** <a href=**"Hello\_World.txt"** download >**Download me!**</a></p>

**  <br><hr><hr><br><br>

**  <input id=**"fileupload"** type=**"file"** name=**"fileupload"** />** 
**
`  `<p class=**"\_inline"**>**Enter Your encryption key:** </p>
**
`  `<input id=**"enc\_key"** type=**"text"** name=**"enc\_key"** />** 
**
`  `<button id=**"generate-key"**> **Generate Key** </button>
**
`  `<button id=**"upload-button"**> **Upload** </button>

**  <br><br><br>
**
`  `<hr><hr><br>



**  <p class=**""**>**To test, try to download the file you just uploaded. The file is encrypted** 

`    `**existed on our server as .ZIP file, you will now get a** 

`    `**uncompressed and decrypted file.**</p><br><p class=**"\_inline"**>**Enter Decryption Key:**</p>
**
`    `<input id=**"dec\_key"** type=**"text"** name=**"dec\_key"** />** 
**
`    `<!--  <button id="download-button"> Decrypt & Download! </button> -->

**    <?php 

`    `**echo** "<br><br><br>Choose the file to download. Here is the list of files on the server: <br>" ;

`    `$path = '/srv/http/uploads';

`    `$files = **scandir**($path);

`    `$files = **array\_diff**(**scandir**($path), **array**('.', '..'));

`    `**foreach**($files **as** $file){

`      `**echo** "<br>- <a class='download-file' href=''>**$file**</a>";

`  `}

`  `?>

**    <script src=**"dist/bundle.js"**></script>

**  </body>

</html>

## <a name="_toc107323763"></a>Encryption logic
Code:

function uploadFile() {

`	`var file = fileupload.files[0];

`	`console.log("FILE IS: " ,file);

`	`var reader = new FileReader();

`	`var key = document.getElementById("enc\_key").value;

`	`var fileEnc = null;

`	`reader.onload = function() {

`	`// var key = "abc123"; // Will later be replaced with user's private key

`	`var wordArray = CryptoJS.lib.WordArray.create(reader.result);

`	`console.log("before: " + wordArray);

`	`var encrypted = CryptoJS.AES.encrypt(wordArray, key).toString();

`	`console.log("after [from encryption]: " + encrypted);

`	`var fileEnc = new Blob([encrypted]);

`	`encryptAndUpload(fileEnc);

`	`}

`	`reader.readAsArrayBuffer(file); 

}

async function encryptAndUpload(file) {

`	`let formData = new FormData();

`	`formData.append("file", file);

`	`let response = await fetch('/upload-form.php', { 

`		`method: "POST", 

`		`body: formData 

`	`});

`	`console.log("Upload, Encryption, and Compression Completed Successfully.")

}

## <a name="_toc107323764"></a>Decryption Logic
Code:

async function decryptAndDownload\_Unzipped() {

`	`var key = document.getElementById("dec\_key").value;

`	`var file\_url = window.location.href + '/uploads/test\_new.zip'

`	`https.get(file\_url, function(res) {

`		`var data = [], dataLen = 0; 

`		`res.on('data', function(chunk) {

`			`data.push(chunk);

`			`dataLen += chunk.length;



`		`}).on('end', function() {

`			`var buf = Buffer.alloc(dataLen);

`			`for (var i = 0, len = data.length, pos = 0; i < len; i++) { 

`			`data[i].copy(buf, pos); 

`			`pos += data[i].length; 

`		`} 

`	`var zip = new AdmZip(buf);

`	`var zipEntries = zip.getEntries();

`	`var decrypted = (CryptoJS.AES.decrypt(zip.readAsText(zipEntries[0]), key));

`	`decrypted = hex2a(decrypted);

`	`downloadStringAsFile("decrypted.txt", decrypted);

`	`});

});

}


# <a name="_toc107323765"></a>References

1. PHP Manual: <https://www.php.net/manual/en/index.php>
1. NodeJS Manual: <https://nodejs.org/en/docs/>
1. CryptoJS Library: <https://cryptojs.gitbook.io/docs/>
1. AdmZip Library: <https://www.npmjs.com/package/adm-zip>
1. W3school: <https://www.w3schools.com/>
53

=======
# my-repo
Secure end-to-end Storage-as-a-system
>>>>>>> origin/main
