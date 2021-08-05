[ * CLICK HERE TO VIEW LIVE VERSION OF THE SITE * ](https://iowhy.com/)

# Introduction
Welcome to my technical project for The Motley Fool. The following is a brief summation of the functions demonstrated through the project. I attempted to solve each of the requirements by creating different elements to demonstrate different knowledges and skill sets.

The elements used are broken up as follows:

   - Custom Plugin “StockFool”
   - 3 Custom Gutenberg Blocks
     - Author Information Block
     - Recommendations listing Block
     - News listings w/ pagination Block
   - Child-Theme for TwentyTwentOne

## StockFool
StockFool is a plugin build to complete the API call portion of the project requirements. Based on its usage it will either populate an action bar at the bottom of the page or display. I used the native WordPress shortcode function to build this. I also implemented an OOP based settings class within the plugin files, however it is only used to store the API key for Financial Modeling Prep.

To active the shortcode use the following format:

[stockdisplay=”Sample Text” type=”bar|box” symbol=”SBUX”]

There are three elements that are grabbed and passed into JS via “wp_localize_script” and “wp_enqueue_script”.

   - “display” is whatever text/content you would like displayed inline of wherever the shortcode is called. Whatever is in the
“display” field will be displayed in highlighted yellow.
   - “type” can be defined as either “box” or “bar”. If set to “bar”, upon mouse over a information bar containing company information will be displayed until the mouseout event triggers.
   - “symbol” insert whatever stock symbol you will to retrieve data on.
   - 
[A demo of the “bar” feature can be found here, on the Stock Recommendation article.](https://iowhy.com/news/starbucks-reports-record-quarter-but-challenges-remain/)

[A demo of the “box” feature can be found here, on the Company Page Requirement page.](https://iowhy.com/starbucks/)

It’s currently limited to one call per page, but could easily be expanded to handle multiple.

## Custom Gutenburg Blocks
I decided to demonstrate my knowledge of one of the newer WordPress features, content blocks for the Gutenburg editor. These are usable on any post type where the Gutenburg editor is enabled. They are essentially customizable widgets, very versatile, very locked down. I use these all the time for adding in advanced features without requiring significant technical knowhow for on the page editors side.

There are three blocks added in total, all of which are built and initialized within the child-theme for TwentyTwentyOne.

## Author block
Drag anywhere on the page to display author’s name and post publish date. Author is defined by selecting a user. Can be expanded to use any data from the user table.

[A demo of the “Author Block” can be found here, on the Stock Recommendation article.](https://iowhy.com/news/starbucks-reports-record-quarter-but-challenges-remain/)

## Recommendations Listing Block
Drag this block anywhere on the page to display a selection of manually set article listings. Once the block is placed, the use can select from any of the “recommendations” post type articles to display them. User can also define what the heading of the block will be displayed as.

[A demo of the “Recommendations Listing Block” can be found here, on the Company Page Requirement page.](https://iowhy.com/starbucks/)

## News Listing w/ Pagination Block
This functions similarly to the “Recommendations Listing Block”, but adds in pagination limited to 10 posts per page.

[A demo of the “News Listing w/ Pagination Block” can be found here, on the Company Page Requirement page.](https://iowhy.com/starbucks/)

## Child-Theme for TwentyTwentyOne
I created a child-theme for the default WordPress theme TwentyTwentOne that is used in the project. The theme includes the following functions:

   - Archive Template for the “Stock Recommendations” post type.
   - Functions.php where all of the block information is called.
   - Template parts for each block

## Archive Template
This is used to meet the requirement of “Create a Stock Recommendation archive page”. It displays the archive posts’ title, (exchange:symbol), and a brief excerpt.

[This can be found here.](https://iowhy.com/recommendations/)

##Functions.php
Here you can see all of the functions that hook the new blocks into WP as well as enqueue some styles and scripts.

## Template Parts
in the /template-parts/blocks/ directory you will find the templates that are used whenever one of the new blocks are called. They are very quick to modify due to their templated nature.

## Additional Information
I used ACF Pro in this project to attach fields to post types, taxonomies, and blocks. I used my personal pro license key for this.

I used CPTUI for creating custom post types and custom taxonomies. I’ve used this plugin for years and it is highly effective for managing custom elements.

## Custom Taxonomy
I created a custom taxonomy called Associated Stock / ‘stock_index’. It has two additional fields added to it via ACF for Exchange and Symbol.

# Requirements
Create a News article
There are several News articles created, mostly to fill out the 10+ pagination requirement. All news posts contain the “Author Info Block” that displays the author’s info as well as the article publication date. There is also a side field for adding an associated stock to the article that is saved to the “stock_index” taxonomy.

[You can see this requirement here.](https://iowhy.com/news/starbucks-reports-record-quarter-but-challenges-remain/)

## Create a Stock Recommendation article
For this I created ‘recommendations’ are a custom post type. It functions similarly to the standard ‘post’, but has the ability to attach an associated stock. It also has access to the ‘author info block’ to meet the author requirements of the project. This is also where you can find the StockFool company information bar on display.

This ajax grabs and displays all the required fields of the project:

   - Company Logo
   - Company Name
   - Exchange
   - Description
   - Industry
   - Sector
   - CEO
   - Website URL
Again, it is currently limited to one per page, but could easily be adapted to multiple listings.

[You can see this requirement here.](https://iowhy.com/recommendations/buy-starbucks/)

## Create a Stock Recommendation archive page
This used a custom archive template that is stored within the child-theme. Relatively basic, displays stock recommendations are defined by the project requirements. I used the standard WordPress pagination function. It displays the archive posts’ title, (exchange:symbol), and a brief excerpt.

[You can see this requirement here.](https://iowhy.com/recommendations/)

## Create a Company Page
I created this page within the base WordPress Pages. It contains all of the listed requirements for the page and uses several custom elements. This page contains the “box” version of the [StockFool](https://iowhy.com/#StockFool) short code Plugin. It also contains the [Custom Gutenburg Blocks](https://iowhy.com/#blocks) [“Recommendations Listings Block”](https://iowhy.com/#recommendations) and [“News Listing w/ Pagination Block“](https://iowhy.com/#news). You can learn more about those features by clicking on any of the above mentioned links.

[You can see this requirement here.](https://iowhy.com/#:~:text=above%20mentioned%20links.-,You%20can%20see%20this%20requirement%20here.,-I%20hope%20you)

## Installation
To install your own version of these files follow the following steps in the following order:
   - Install WordPress on your server.
   - Upload included TwentyTwentyOne Child Theme and active it.
   - Install StockFool plugin and Active it.
   - Install CPTUI plugin and active it. Copy and paste text from https://github.com/FoolishHopeful/StockFool/blob/main/CPTUI.txt into CPTUI Importer.
   - Install ACF and Activte it. Then Import https://github.com/FoolishHopeful/StockFool/blob/main/acf-export-2021-08-05.json to create correct fields.
   - Use the offical WordPress Importer Tool to import https://github.com/FoolishHopeful/StockFool/blob/main/motleyfoolproject.WordPress.2021-08-05.xml
   - 
[ * CLICK HERE TO VIEW LIVE VERSION OF THE SITE * ](https://iowhy.com/)

I hope you enjoyed my work and look forward to hearing for you!

From,
Drew (Foolish Hopeful)
