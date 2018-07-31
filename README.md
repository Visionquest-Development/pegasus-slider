# Pegasus-slider
 
## Usage
How to use in your WordPress site<br>
`[slider][slide class="testing"]<img class="alignnone size-full wp-image-12" src="http://www.fillmurray.com/960/550" alt="Gold-and-Black-Logo">[/slide][slide]<img class="alignnone size-full wp-image-12" src="http://www.fillmurray.com/600/350" alt="Gold-and-Black-Logo">[/slide][/slider]`<br>
Or<br>
`[news_slider the_query="showposts=100&post_type=post"]`<br>
Or<br>
`[thumb_slider][thumb_slide title="slide1" number="1"]<img src="http://slippry.com/assets/img/image-1.jpg" alt="This is caption 1">[/thumb_slide][thumb_slide title="slide2" number="2"]<img src="http://slippry.com/assets/img/image-2.jpg" alt="This is caption 2">[/thumb_slide][thumb_slide title="slide3" number="3"]<img src="http://slippry.com/assets/img/image-3.jpg" alt="This is caption 3">[/thumb_slide][thumb_slide title="slide4" number="4"]<img src="http://slippry.com/assets/img/image-4.jpg" alt="This is caption 4">[/thumb_slide][/thumb_slider]`<br>
Shortcode Attributes: http://pegasustheme.com/pegasus-slider/


## Installation
How to install to your WordPress site

### Simple Instructions 
Go to [Github](https://github.com/Visionquest-Development/pegasus-slider "Github") and click "Clone or download" and make sure it says "Clone with HTTPS" at the top and click "Download Zip" and save it to a folder on your PC. Then, go to WordPress Back-end and go to Plugins -> Add New and then click on "Upload Plugin" and upload the zip file you downloaded from Github.

### Advanced Setup 
#### 1.) Upload via FTP/WordPress Admin<br>
Download zip file from [here](https://github.com/Visionquest-Development/pegasus-slider/archive/master.zip "Github") and on extraction make sure the folder name you extract to is saved as pegasus-slider instead of pegasus-slider-master
Then upload to you server using an FTP program or Use the WordPress Plugin Upload feature in the WordPress Admin.<br>
#### 2.) In the terminal:
###### For https connection use:
`git clone https://github.com/Visionquest-Development/pegasus-slider.git pegasus-slider`

###### For SSH implementation use this command and make sure you have the SSH key setup on both your terminal and github account. You will need to use your passkey for each update.
`git clone git@github.com:Visionquest-Development/pegasus-slider.git pegasus-slider`



## How to update
### Simple Instructions
Use the WordPress Admin or your favorite FTP program to delete the old plugin from the plugins folder. Then follow the Installation instructions again from above.

### Advanced Setup 
If you used the Advanced Setup, all you need to do is `cd /path/where/plugin/exists` && `git pull`.


## How to contribute
If you plan on helping make this plugin better then please follow our guidelines for contributions. We recommend you use a terminal and git clone our repository by using the Advanced Installation Instructions from above. Then, use `git checkout -b new-branch-name` to create your own branch, and rename it to whatever you want by replacing `new-branch-name`. Make your changes and then add and commit them to your branch. Make sure to use `git push -u origin new-branch-name` with the new name when you get done committing your changes to set the upstream for your branch. Then, login to github.com and go to the repo you updated with your new branch and submit a Pull Request. We will review Pull Requests and accept them if it fits with our guidelines and current setup.




