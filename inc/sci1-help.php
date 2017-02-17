<?php 
/**
 * Science Magazine help page
**/ 

add_action('admin_menu', 'sci1_theme_help');

function sci1_theme_help() {
	if( is_super_admin() ){
	add_theme_page('Science Magazine help', 'Science Magazine Help & Guide', 'read', 'sci1_help','sci1_help_page');
}
}
function sci1_help_page(){ ?>

   <div class="container wrap welcome-panel">
      <h3 class="center alt">&ldquo;Science Magazine Theme&rdquo; Documentation by &ldquo;StepFox&rdquo;</h3>
      <hr>
      <h1 class="center">&ldquo;Science Magazine&rdquo;</h1>
      <div class="borderTop">
         <div class="span-6 colborder info prepend-1">
            <p class="prepend-top">
               <strong>
               Created: 28/08/2016<br>
               By: StepFox<br>
               Email: <a href="StepFoxHelp@gmail.com">StepFoxHelp@gmail.com</a>
               </strong>
            </p>
         </div>
         <!-- end div .span-6 -->		
         <div class="span-12 last">
            <p class="prepend-top append-0">Thank you for purchasing our theme. If you have any questions that are beyond the scope of this help file, please feel free to email us on the following mail: StepFoxHelp@Gmail.com . Thanks so much!</p>
         </div>
      </div>
      <!-- end div .borderTop -->
      <hr>
      <h2 id="toc" class="alt">Table of Contents</h2>
      <ol class="alpha">
         <li><a href="#disclaimer">Disclaimer</a></li>
         <li><a href="#installation">Installation</a></li>
         <li><a href="#xmldata">XML Data</a></li>
         <li><a href="#themeoptions">Theme Options</a></li>
         <li><a href="#widgetareas">Widgets and Widget Areas</a></li>
         <li><a href="#widgetdesc">Widget Descriptions</a></li>
         <li><a href="#images">Images</a></li>
         <li><a href="#Videos">Videos</a></li>
         <li><a href="#reviews">Reviews</a></li>
         <li><a href="#gallery">Gallery</a></li>
         <li><a href="#cssFiles">CSS Files and Structure</a></li>
         <li><a href="#javascript">JavaScript</a></li>
      </ol>
      <hr>
      <h3 id="disclaimer"><strong>1) Disclaimer</strong> - <a href="#toc">top</a></h3>
      <p>We do offer support for the theme and its core features and functionality. We cannot guarantee that this theme will function with all third-party components and plugins. The Science Magazine theme is presented as is.</p>
      <hr>
      <h3 id="installation"><strong>2) Installation</strong> - <a href="#toc">top</a></h3>
      <ol>
         <li>Make sure that you have the latest version of Wordpress installed.</li>
         <li>
            Upload the Science Magazine theme to Wordpress in one of two different ways
            <p>	- Extract the SceinceMag-theme.zip and upload the 'Science Mag' folder to the /wp-content/themes/ directory on your server.</p>
            <p>- Or go to Appearance > Themes and click on the Install Themes tab at the top. Then click Upload and select SceinceMag-theme.zip and click Install Now.</p>
         </li>
         <li>After you upload the theme, activate it by going to Appearance > Themes and click Activate underneath the Science Magazine screenshot.</li>
      </ol>
      <hr>
      <h3 id="xmldata"><strong>3) XML DATA</strong> - <a href="#toc">top</a></h3>
      <p>The Science Magazine theme comes with dummy content via an XML file. This file includes dummy posts, pages, fighters, events, categories, one dummy photo and dummy ads. To install the XML data, go to Tools > Import, click on WordPress then select the science-mag.xml file located in the XML Data folder of your original zip file. Then click Upload file and import. Choose a user to assign the posts to and make sure you click the Download and import file attachments checkbox and then click submit.</p>
      <hr>
      <h3 id="themeoptions"><strong>4) Theme Options</strong> - <a href="#toc">top</a></h3>
      <p>Science Magazine comes with a plethora of custom theme Options that allow you to play with the design and the layout without touching the code. To edit the Theme Options, go to Appearance>Customize.</p>
      <ol>
         <li>
            <strong>Site Title, Tagline, Copyright Text and Site Icon</strong>
            <p>- This is where you set your site title, the tagline and the copyright text in the footer along with the 'Site Icon'. The site icon will appear as your favicon, mobile device bookmark icon, etc... Pretty much self explanatory.</p>
         </li>
         <li>
            <strong>Logo Options</strong>
            <p>	- This is where you upload your main logo, and the footer logo. Additionaly you can upload a 'Facebook Homepage Image' which will be displayed when someone shares your homepage on Facebook. The Logo image should be 294x115 PNG image, and the Facebook image should be 486x254 in size.</p>
         </li>
         <li>
            <strong>Colors</strong>
            <p>	- The colors menu. From here you have control over the color pallete on your site. At first sight it might seem that there are lots of colors to set up, but eventually you want to have as much contorol as you can over the color aspect of your site. Hence, we decided to give you as much flexibilty as we could.</p>
         </li>
         <p><strong>- Top Posts Title Color</strong>: Select the color of the post titles in the header.</p>
         <p><strong>- Top Posts Category Color</strong>: Select the color of the category of the post titles in the header.</p>
         <p><strong>- Top Posts Background Color</strong>: Select the color of the background for the post titles in the header.</p>
         <p><strong>- Menu Background Color</strong>: This is where you change the color for the header background.</p>
         <p><strong>- Menu Hover Color:</strong> Use this option to change the color of the menu items when users hover over them.</p>
         <p><strong>- Menu Font Color:</strong> Select the color for the font in the menu.</p>
         <p><strong>- Super Slider Overlay Color</strong>: This is where you change the color gradient on the Super Slider widget.</p>
         <p><strong>- Super Slider Title Color</strong>: This is where you change the color of the title font on the Super Slider widget.</p>
         <p><strong>- Main Color</strong>: This is the color of the logo background, and other details around the site.</p>
         <p><strong>- Widget Overlay Color</strong>: The color that overlays the images on some of the widgets.</p>
         <p><strong>- Widget Text Color</strong>: The color of the title text on widgets that have overlay.</p>
         <p><strong>- Popular Background (category page):</strong> This determines the background to the popular posts thta are present on the category pages.</p>
         <p><strong>- Popular Text Color (category page):</strong> This determines the color of the text on the popular section.</p>
         <p><strong>- Popular 'read more' Color (category page):</strong> This determines the color of the clickable link usualy named 'read more'.</p>
         <p><strong>- Background Color:</strong> This is the color for the background of the site.</p>
         <p>	- On the below image you can see how most of the site looks like with the demo colors. On the bottom of the image you can see each color we have selected for each of the 22 color slots, to get that demo look.</p>
         <img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/help/slika1.jpg"/>
         </li>				
         <li>
            <strong>Design</strong>
            <p><strong>- Body Width:</strong> This is where you select the width of the site basically. There are 3 options, 1903px(full width), 1596px, and 1290px. One thing to remember note is, if you change the size of the body width from smaller to bigger, and you already have uploaded the images before, than you will need to reupload them with proper size, or sue the regenerate thumbnails plugin.</p>
            <p><strong>- Slider Transition:</strong> You have a couple of slider loading effects(slider transitions) to choose from.</p>
            <p><strong>- Image Effect:</strong> This option changes the effect that appears when users hover over the images on your site. You can select one out of the 5 options available.</p>
            <p><strong>- Sticky Menu:</strong> Here you can trun on or off the option for the menu, whether you want it follow the user when he is scrolling down, or not.</p>
            <p><strong>- Widget Load Effect:</strong> Here you select the way that widgets load up when they gat into the viewport. There are 10 options you can choose from.</p>
            <p><strong>- Widget Overlay Opacity:</strong> This is where you determine the opacity of the overlay on widgets.</p>
         </li>
         <li>
            <strong>Typography</strong>
            <p><strong>- Font Size:</strong> Changing this value will affect all fonts on the site.</p>
            <p><strong>- Main Font:</strong> This is where you select the font for your site. The main font is present all throughout the site.</p>
            <p><strong>- Secondary Font:</strong> This is the secondary font of the site. It usually represents the smaller important elements, like the categories, tags, authors, etc. Also, this is the font of the menu.</p>
            <p><strong>- Small Font:</strong> This is where you select the font for your site. The main font is present all throughout the site.</p>
            <p><strong>- Menu Font Weight:</strong> This is where you determine the font wieght for the menu. You can select regular font, semi-bold and bold.</p>
            <p><strong>- Menu Font Size:</strong> Here you can select the size of the menu font.</p>
            <p><strong>- Widget Title Font Weight:</strong> This is where you change the font for the widget titles only.</p>
            <p><strong>- Featured Title Style:</strong> Here you can select the size of the menu font.</p>
            <p><strong>- Post Page Font Size:</strong> Here you can select the size of the menu font.</p>
            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/slika2.jpg"/>
         </li>
         <li>
            <strong>Header Posts</strong>
            <p><strong>- Header Posts Category:</strong> If you selected regular posts, then this is where you determine what category should those posts be. Also you can make the latest 3 posts appear by selecting 'Latest'.</p>
            <p><strong>- Header Dropdown Posts Visibility:</strong> This toggles on/off the Dropdown posts in the header.</p>
            <p><strong>- Header Dropdown Posts Time Interval:</strong> This determines the time period taken into account when displaying the posts. You can have it set weekly. monthly, yearly,etc.. </p>
            <p><strong>- Header Dropdown Date Visibility:</strong> Toggle on or off the visibility of the posts date in the header dropdown section.</p>
            <p><strong>- Header Dropdown Category Visibility:</strong> Toggle on or off the visibility of the posts category in the header dropdown section.</p>
            <p><strong>- Header Dropdown Author Visibility:</strong> Toggle on or off the visibility of the posts author in the header dropdown section.</p>
         </li>
         <li>
            <strong>Post Page Options</strong>
            <p>- Like the title suggests, here you have the options for the post page. You basically can decide whether to show or hide the social buttons, tags, comments and navigation links (next/prev post), etc. Also here you determine whether the title of the post page should be uppercase or not, whether the text should star with drop caps and similar options. Another thing you can do here is to select what the related posts on the bottom of the page are determined by. You can select related posts by category, tags or author.</p>
         </li>
         <li>
            <strong>Category & TV Page Options</strong>
            <p>- This is all about the category and TV pages. Here you determine how many posts should be visible per category page, whether the category page itself should start with a big image, displaying that month/week/day's 4 most popular articles, and what type of blogroll style should portray the remainig posts on the page. You can also select whather the category page should display at the bottom of the page, another set of popular posts, and if so for what period of time. You can also select the popular posts from last week, last month or forever. As for the Tv page here you select the widget style that displays the video posts under the main video. You can select one out of 3 styles.</p>
         </li>
         <li>
            <strong>Translate</strong>
            <p>- If your websites language is not English, this is where you set up the translation. There are a few words throughout the site like read more, search, share, etc.. that you might want to translate to your language. This is where you do it.</p>
         </li>
         <li>
            <strong>Social Settings</strong>
            <p>- This is where you fill in your social accounts. Just type your username/handle under the appropriate social media platform, and the rest will take care of itself.</p>
         </li>
         <li>
            <strong>Tracking</strong>
            <p>- This helps you keep track of statistics. Simply copy and paste the code from google analytics(or any other) to the appropriate field and youll be ready to view your visitor statistics.</p>
         </li>
         <li>
            <strong>Background Image</strong>
            <p>- If you dont want a solid color for a background, you can upload an image. Be it a nice landscape, a cool city skyline or a subtle pattern, here is where you do it.</p>
         </li>
         <li>
            <strong>Menus</strong>
            <p>- Science Magazine Theme has predefined space for you to place 2 menus. Here you choose where to display the menus you have created. See the 
               screenshot below for reference. Select which menu appears in each location. You can edit your menu content on the Menus screen 
               in the Appearance section. For more information on how to use the Wordpress custom menu feature, <a href="http://codex.wordpress.org/Appearance_Menus_Screen">click here</a>. 
               (http://codex.wordpress.org/Appearance_Menus_Screen)
            </p>
         </li>
      </ol>
      <hr>
      <h3 id="widgetareas"><strong>5) Widgets and Widget Areas</strong> - <a href="#toc">top</a></h3>
      <p>Science Magazine comes packed with 19 custom widgets you can use almost everywhere. Basically every widget fits in every area, depending on what size you select for it, so you are free to experiment.
         To activate a widget, go to Appearance > Widgets and drag and drop a widget from the Available Widgets box to the widget areas. Or you can do the same by going to Appearance>Customize where you can see the widgets area at the bottom of the menu. This way you can see the widgets in the live preview right away.
      </p>
      <img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/slika3.jpg"/>
      <hr>
      <h3 id="widgetdesc"><strong>6) Widget Descriptions</strong> - <a href="#toc">top</a></h3>
      <p>Like we mentioned before, you can place almost any widget anywhere. Feel free experimenting with your layout, or use one of the suggested layouts we have already made. Remember almost every widget can have different width like shown in the example below. By using the widgets like lego blocks, that's how you basically build your site with Science Mag</p>
      <img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/slika4.jpg"/>
      <ol>
         <li>
            <strong> Super Slider</strong>
            <p>The super slider displays 1 post at a time. This widget has 2 forms, you can select either full width, or the width of the body. Also You can specify how many slides should the widget display. /p>
         </li>
         <li>
            <strong> Slider</strong>
            <p>This is the typical slider widget. It displays posts based on categories. You can also select if the control thumbs are visible on the slider, or rather use the arrows as a navigation.</p>
         </li>
         <li>
            <strong> Carousel Widget</strong>
            <p>This widget displays posts from a category of your choice. Enter a title for this widget and select the category you would like to use. You can also select "All Categories" to display the latest posts from your site. There is also an option that lets you choose how many posts you would like to display, and if you would like the author of those posts to be visible.</p>
         </li>
         <li>
            <strong> Big Featured Images</strong>
            <p>This widget displays posts with bigger images. It also can display your review posts only or select one of the categories. If you want to display reviews, tick the 'filter reviews' box. There is also an option that lets you choose how many posts should be visible. And the option to decide if you want the authors, the date and text excerpts of the posts to be visible.</p>
         </li>
         <li>
            <strong> Huge Featured Images</strong>
            <p>This widget displays posts with even bigger images. Each post displayed in this widgets takes 2/4 of the body, thus it only comes in 2/4 or 4/4 widths. It also can display your review posts only or select one of the categories. If you want to display reviews, tick the 'filter reviews' box. There is also an option that lets you choose how many posts should be visible. And the option to decide if you want the author and the date of the posts to be visible.</p>
         </li>
         <li>
            <strong> Shortcode Widget and Row Holder</strong>
            <p>This is a widget that lets you paste the shortcodes that you want to use on the theme. You can select the size of it, thus making sure that it does not mess up the layout. Additionaly you can use this widget to straighten the widgets. For example if you want your widgets be aligned, but an pocket of empty space created by the widgets above does not allow the widgets to align, you use this widget empty, select it's size and it will act like an invisble line that will keep the widgets below it aligned. </p>
         </li>
         <li>
            <strong> Title Widget</strong>
            <p>Very useful widget for creating titles that can incorporate a couple of widgets. You can also link to a page of your choice, and leave a neat subtitle.</p>
         </li>
         <li>
            <strong> Ticker</strong>
            <p>This is a typical ticker widget that displays breaking news, or any category that you select for it. It can be full width, or the width of the body maiking it perfect for you to combine with other widgets. You can also add a small sign, or word, that will separate the posts.</p>
         </li>
         <li>
            <strong> Blogroll 1</strong>
            <p>A typical blog posts widget, that displays your posts in a blog roll. You can select how many posts you want to be displayed and of course, what category should they be. Also the lenght of the excerpt is determined by you, and the visibility of the authors and date.</p>
         </li>
         <li>
            <strong> Blogroll 2</strong>
            <p>Another widget that displays posts in a blog style, only with much bigger images. You have the same options as the previous Blogroll 1 widget, like the visibility of the author,date and the number of posts it should display.</p>
         </li>
         <li>
            <strong> Small Featured Images</strong>
            <p>This widget displays a certain category of your choosing, and you have the option to select the visibilty of the author, and date. Also you can select how many posts are displayed, and the option to filter only the reviews.</p>
         </li>
         <li>
            <strong> TV-Ajax-Widget</strong>
            <p>Same as the previous Tv-Widget, only this one displays the videos directly. Meaning that when you click on it the video plays right away, rather than taking you to the video post page. It also sports a carousel, so the user can easily select from the latest videos you have uploaded.</p>
         </li>
         <li>
            <strong> Trending Posts</strong>
            <p>A simple widget that displays the most popular/visited posts on your site. You can also set up the number of posts displayed.</p>
         </li>
         <li>
            <strong> Newsroll</strong>
            <p>A simple widget that displays the latest posts on your site. You can also set up the number of posts it should display.</p>
         </li>
         <li>
            <strong> Social Widget</strong>
            <p>This widget displays your social media. Depending on what social media you want to set up, you would need to enter the handle, key, ID, etc.. This widget has 2 forms, you can change it by selecting the vertical, or horizontal layout.</p>
         </li>
         <li>
            <strong> Thumbnails</strong>
            <p>Just like the previous widget, it displays the latest posts from a category or the latest posts in general. The difference being that these posts are displayed with small thumbs. You can set how many of them should be visible.</p>
         </li>
         <li>
            <strong> About Us Widget</strong>
            <p>Like its name suggests, this widgets lets you write something about yourself, so your visitors can get to know you better.</p>
         </li>
         <li>
            <strong> Ad Widget</strong>
            <p>This is where you place your ads. Just copy the Ad code in the appropriate field, or paste the image url and where it should link to and you have the ad ready.</p>
         </li>
         <li>
            <strong> Video Widget</strong>
            <p>This widget displays a video that can be played directly on the homepage, or where ever you place it. Just add a link to the video and thats it.</p>
         </li>
      </ol>
      <hr>
      <h3 id="images"><strong>7) Images</strong> - <a href="#toc">top</a></h3>
      <p>Science Magazine Theme uses Wordpress' built-in featured image feature to handle image management. The recommended size for images to show properly on the site is 900x560. However, it all depends on whether you use the full width option for the post page fatured image, and/or the fullwidth body size. If so, you will need to upload bigger images than that. To set the featured image for a post, go to Posts > Add New (or edit an existing post) and click the set featured image in the featured image box. If the desired image is not already uploaded simply click on upload image and then select one and click set as featured image. Science-Magazine theme will take care of the rest in generating the smaller thumbnails that show up in the various places around the site.
         <img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/slika5.jpg"/>
      </p>
      <hr>
      <h3 id="mediasize"><strong>8) Media Size</strong> - <a href="#toc">top</a></h3>
      <p>Science Mag lets you choose from a couple of options, what size should the featured image should be. You can select between full width, body width, normal and no media. Depending on what have you selected make sure you upload image with proper size.
         <img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/slika6.jpg"/>
      </p>
      <hr>
      <h3 id="Videos"><strong>9) Videos</strong> - <a href="#toc">top</a></h3>
      <p>Science Magazine Theme uses Wordpress' built-in featured video feature for easy video management. When creating a post, select 'video' under 'format' options and then simply copy the video link and paste it in the Featured Video area. Science Mag will take care of the rest and your video will automatically appear on the video page as well. The video page is basically a page containing all the videos in your articles so far, in a nice layout which makes it easier to browse them and also more enjoyable to watch. To have the Video(TV) Page, make sure that when you go to Appearance>Menus, in the right corner of the screen, under 'Screen Options' you have ticked the format box. Then just add the Video format to the menu.
         <img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/slika7.jpg"/>
      </p>
      <hr>
      <h3 id="reviews"><strong>10) Reviews</strong> - <a href="#toc">top</a></h3>
      <p>Its really easy to set up a review post. Just like the video post, all you need to do is, select review from the format options on your post page. Once you do that, new options will appear under the text area. Here you can upload the image and give the name of the subject your are reviewing, and add a few short pros and cons to it (good and bad). Also here you add how many parameters the subject will be reviewed on, and what numbers it scores on each on it. The total amount of the scores will be summed up and shown over the image. 
         <img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/slika8.jpg"/>
      </p>
      <hr>
      <h3 id="gallery"><strong>11) Gallery</strong> - <a href="#toc">top</a></h3>
      <p>With Science Magazine Theme it is really easy to set up a gallery page. All you have to do is select the gallery format on the right hand side, and then just upload the images in the new gallery field that opens up under the content area. And that's about it.
         <img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/slika9.jpg"/>
      </p>
      <hr>
      <h3 id="cssFiles"><strong>11) CSS Files and Structure</strong> - <a href="#toc">top</a></h3>
      <ul>
         <li>
            <strong>style.css</strong> - Main theme stylesheet 
         </li>
         <li>
            <strong>/inc/sci1-editor-style.css</strong> - Editor theme stylesheet 
         </li>
         <li>
            <strong>/inc/sci1-post-style.css</strong> - Post stylesheet 
         </li>
         <li>
            <strong>/inc/sci1-widget-presets.css</strong> - demo picker stylesheet 
         </li>
         <li>
            <strong>/css/buddypress.css</strong> - buddypress stylesheet 
         </li>
         <li>
            <strong>/css/bbpress.css</strong> - bbpress stylesheet 
         </li>
         <li>
            <strong>/inc/woocommerce.css</strong> - woocommerce stylesheet 
         </li>
      </ul>
      <hr>
      <h3 id="javascript"><strong>12) JavaScript</strong> - <a href="#toc">top</a></h3>
      <p>Javascript files.</p>
      <ul>
         <li><strong>/js/sci1-post.js</strong> - Post scripts</li>
         <li><strong>/js/sci1-scripts.js</strong> - Site scripts</li>
         <li><strong>/js/jquery.flexslider-min.js & jquery.flexslider.js</strong> - Flex Slider</li>
         <li><strong>/js/ajax-video-widget.js</strong> - video ajax</li>
         <li><strong>/js/sci1-one-button-install.js</strong> - install script</li>
         <li><strong>/js/respond.js</strong> - responsive script</li>
         <li><strong>/js/smoothscroll.js</strong> - smooth scroll script</li>
      </ul>
      <hr>
      <p><strong>THANK YOU VERY MUCH</strong></p>
      <p>Once again, thank you so much for purchasing this theme. As I said at the beginning, we'd be glad to help you if you have any questions relating to this theme. We'll do our best to assist.</p>
      <p class="append-bottom alt large"><strong>StepFox</strong></p>
      <p><a href="#toc">Go To Table of Contents</a></p>
      <hr class="space">
   </div>
   <!-- end div .container -->


<?php } ?>