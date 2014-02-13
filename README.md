shipwire
========
Well that was an interesting experience. I had huge problems deploying my project to the web server as it wasn't liking something in my code. After much hair pulling and testing bits of code at a time, I discovered my web server's version of PHP does not like it when I call the empty() function on an array to check if it's empty or not. So I ended up changing it to if(array == NULL). Now I have to deal with the problem that my javascript isn't working properly either. 

Aside from using a jquery tablesorter plugin, I wrote every bit of code myself...which made this project more than I had bargained for. The site is so janky and it is because I spent too much time on some parts of it and ended up having to rush and write sloppy code =( in order to try to fix the major bugs in time. And no, I did not fix a lot of the bugs. 

One problem I had was that I wasn't sure how I was supposed to present all the products. I wrote the code so that all the product information would show next to the product name and I did this with a table. Then I found out I was to display the product information when you click on the product name. Unfortunately I had written a lot of javascript, php, and html to display and edit the table cells and I was not going to be to switch everything to an unordered list. 

I'll list some of the bugs I have so far
For the front page:
- I do not want the textarea to be resizable
- I did not style the page much and I would like to add better design 
- the input fields highlighting red/green are not in sync

edit page:
- if I had time I would not use tables, I would have something like a module pop up when you click on a name so you can view details and edit/delete.
- the way it stands right now, when you click on the product name, the items,borders,backgrounds etc. that show are really off. I don't even know where to get started there.
- I did not have time to complete the update product function.
- I did allow the deletion of products but this may not be possible if the darn delete buttons stay hidden!

I did not document my code well at all due to the rushing =(
