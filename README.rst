=============================
Question2Answer Share v 1.0b1
=============================
-----------
Description
-----------
This is a plugin for **Question2Answer** that provides basic social sharing functionality. 

--------
Features
--------
- currently supports five services: Facebook, Google+, Twitter, LinkedIn and Email
- toggle each button individually via admin interface
- set button order using weight
- buttons are displayed *after* a question's response buttons - see below to change this
- option to include suggestion text when there is no answer
- optional share widget for sidebar

------------
Installation
------------
#. Install Question2Answer_
#. Get the source code for this plugin from github_, either using git_, or downloading directly:

   - To download using git, install git and then type 
     ``git clone git://github.com/NoahY/q2a-share.git share``
     at the command prompt (on Linux, Windows is a bit different)
   - To download directly, go to the `project page`_ and click **Download**

#. navigate to your site, go to **Admin -> Plugins** on your q2a install and select which buttons to show, then click **Save**.
#. To change the position of the buttons, edit qa-share-layer.php and follow standard theming practices, as outlined here_

.. _Question2Answer: http://www.question2answer.org/install.php
.. _git: http://git-scm.com/
.. _github:
.. _project page: https://github.com/NoahY/q2a-share
.. _here: http://www.question2answer.org/layers.php

----------
Disclaimer
----------
This is **beta** code.  It is probably okay for production environments, but may not work exactly as expected.  Refunds will not be given.  If it breaks, you get to keep both parts.

-------
Release
-------
All code herein is Copylefted_.

.. _Copylefted: http://en.wikipedia.org/wiki/Copyleft

---------
About q2A
---------
Question2Answer is a free and open source platform for Q&A sites. For more information, visit:

http://www.question2answer.org/

