<?php
/**
 * PureMVC PHP Basic Demo
 * @author Omar Gonzalez :: omar@almerblank.com
 * @author Hasan Otuome :: hasan@almerblank.com
 *
 * Created on Sep 24, 2008
 * PureMVC - Copyright(c) 2006-2008 Futurescale, Inc., Some rights reserved.
 * Your reuse is governed by the Creative Commons Attribution 3.0 Unported License
 *
 * This template file generates the Basic Demo view.  The ApplicationMediator replaces the css token with
 * the loaded CSS file.
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" >
<head>
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
	<meta name="author" content="Dave Shea" />
	<meta name="keywords" content="design, css, cascading, style, sheets, xhtml, graphic design, w3c, web standards, visual, display" />
	<meta name="description" content="A demonstration of what can be accomplished visually through CSS-based design." />
	<meta name="robots" content="all" />

	<title>css Zen Garden: The Beauty in CSS Design</title>

	<!-- to correct the unsightly Flash of Unstyled Content. http://www.bluerobot.com/web/css/fouc.asp -->
	<script type="text/javascript"></script>
	<style type="text/css" media="all">
		{css}
	</style>
	
</head>

<!--


	This xhtml document is marked up to provide the designer with the maximum possible flexibility.
	There are more classes and extraneous tags than needed, and in a real world situation, it's more
	likely that it would be much leaner.
	
	However, I think we can all agree that even given that, we're still better off than if this had been
	built with tables.


-->

<body onload="window.defaultStatus='css Zen Garden: The Beauty in CSS Design';" id="css-zen-garden">

<div id="container">
	<div id="intro">
		<div id="pageHeader">
			<h1><span>css Zen Garden PureMVC PHP Basic Demo</span></h1>
			<h2><span>The Beauty of <acronym title="Cascading Style Sheets">CSS</acronym> Design powered by PureMVC PHP</span></h2>
		</div>

		<div id="quickSummary">
			<p class="p1"><span>A demonstration of what can be accomplished with PureMVC PHP. Select any style sheet from the list and PureMVC PHP will change the CSS Zen Garden style.</span></p>
			<p class="p2"><span>Download the sample <a href="#" title="This page's source HTML code, not to be modified.">html file</a> and <a href="#" title="This page's sample CSS, the file you may modify.">css file</a></span></p>
		</div>

		<div id="preamble">
			<h3><span>The Road to Enlightenment</span></h3>
			<p class="p1"><span>PureMVC is a lightweight framework for creating applications based upon the classic Model, View and Controller concept.</span></p>
			<p class="p2"><span>Based upon proven design patterns, this free, open source framework which was originally implemented in the ActionScript 3 language for use with Adobe Flex, Flash and AIR, has now been ported to nearly all major development platforms.</span></p>
			<p class="p3"><span>The choice of framework for your application heavily influences your architecture, thereby affecting the total cost of ownership by impacting future maintainability. Choose wisely.</span></p>
		</div>
	</div>

	<div id="supportingText">
		<div id="explanation">
			<h3><span>So What is This About?</span></h3>
			<p class="p1"><span>The PureMVC framework has a very narrow main goal: to help you separate your application’s coding concerns into three discrete tiers; Model, View and Controller.</span></p>
			<p><span>To do this well and push the framework to a stable state is single guiding intent.</span></p>
			<p><span>Extending the usefulness of the framework by providing utilities and demos that illustrate the overall best practices for use of the framework and utilities is the next.</span></p>
			<p class="p2"><span>This basic demo demonstrates a working example of a PureMVC PHP application allowing you to switch between different <a href="http://www.csszengarden.com">CSS Zen Garden</a> styles.</span></p>
		</div>

		<div id="participation">
			<h3><span>Participation</span></h3>
			<p class="p1"><span>Become A Project Owner! If you have a PureMVC project idea or would like to begin work on a Port that does not yet have an owner, please speak up here! The public gets read access to all repositories, Project Owners get read/write to their project. 
			<p class="p2"><span>Be A Regular Contributor! If you just want to contribute to an existing project, making some improvement or fixing a bug, but don't want to 'own' a project per se, you'll want to see a separate post (to be made) in this forum about creating a subversion patch. </span></p>
			<p class="p3"><span>There's much more to come, this is only the start. I hope everyone can get an idea of the direction this thing is going. We want a very orderly expansion of the codebase to cover many languages and adjacent technologies.</span></p>
		</div>

		<div id="benefits">
			<h3><span>Benefits</span></h3>
			<p><span><strong>Useful implementation classes</strong> Framework can be used 'out-of-box' with minimal implementation requirements. Facade class provides a single collaborator for communication with the core framework.</span></p>
			<p><span><strong>Loosely-coupled architecture</strong> Promotes reusability of view components and model data objects and services. Incorporates publish / subscribe-style notifications. Creates clear separation of client-tier coding concerns.</span></p>
			<p><span><strong>Programmed to interfaces</strong> Framework supports extensibility by sub- classing or interface implementation. Interfaces defined for all framework classes. All classes built with extension in mind; protected methods and variables and interface parameters in method signatures. Framework provides for future extension via other libraries by grouping supporting patterns into a separate package, and making no core dependencies on the pattern packages.</span></p>
			<p class="p1"><span><strong>Well documented</strong> Source code freely available. Complete API documentation. Conceptual and UML Diagrams. Unit tests for all classes and methods. Plenty of demos show the basics and demonstrate best practices. Implementation Idioms & Best Practices document by the architect. Professional courseware under development has already been beta-tested by hundreds of students.</span></p>
		</div>

		<div id="requirements">
			<h3><span>Requirements</span></h3>
			<p class="p1"><span>In order to get started with PureMVC PHP a basic understand of OOP concepts and PHP is required.</span></p>
			<p class="p2"><span>Go to the <a href="http://puremvc.org/component/option,com_wrapper/Itemid,26/">PureMVC Forums</a> for more information and discussion!</span></p>
		</div>

		<div id="footer">
			<a href="http://validator.w3.org/check/referer" title="Check the validity of this site&#8217;s XHTML">xhtml</a> &nbsp; 
			<a href="http://jigsaw.w3.org/css-validator/check/referer" title="Check the validity of this site&#8217;s CSS">css</a> &nbsp; 
			<a href="http://www.php.net" title="Read about the server language powering this site">php</a> &nbsp; 
			<a href="http://www.puremvc.org" title="Read about the application framework powering this site">puremvc</a>
		</div>

	</div>

	
	<div id="linkList">
		<!--extra div for flexibility - this list will probably be the trickiest spot you'll deal with -->
		<div id="linkList2">

		<!-- If you're wondering about the extra &nbsp; at the end of the link, it's a hack to meet WCAG 1 Accessibility. -->
		<!-- I don't like having to do it, but this is a visual exercise. It's a compromise. -->
			<div id="lselect">
				<h3 class="select"><span>Select a Design:</span></h3>
				<!-- list of links begins here. There will be no more than 8 links per page -->
				<ul>
					<li><a href="?" title="AccessKey: 1" accesskey="1">Simple</a> by <a href="http://www.shawnchin.net/" class="c">Shawn Chin</a>&nbsp;</li>
					<li><a href="?c=cubegarden" title="AccessKey: a" accesskey="a">Cube Garden</a> by <a href="http://www.804case.com/" class="c">Masanori Kawachi</a>&nbsp;</li>
					<li><a href="?c=ordered" title="AccessKey: b" accesskey="b">OrderedZen</a> by <a href="http://www.orderedlist.com/" class="c">Steve Smith</a>&nbsp;</li>
					<li><a href="?c=proud" title="AccessKey: c" accesskey="c">Make 'em Proud</a> by <a href="http://skybased.com/" class="c">Michael McAghon and Scotty Reifsnyder</a>&nbsp;</li>
					<li><a href="?c=cssco" title="AccessKey: d" accesskey="d">CSS Co., Ltd.</a> by <a href="http://www.benklemm.de/" class="c">Benjamin Klemm</a>&nbsp;</li>
					<li><a href="?c=business" title="AccessKey: e" accesskey="e">Business Style</a> by <a href="http://www.klavina.com/" class="c">Gunta Klavina</a>&nbsp;</li>
					<li><a href="?c=contempo" title="AccessKey: f" accesskey="f">Contempo Finery</a> by <a href="http://www.intersmash.com/" class="c">Ro London</a>&nbsp;</li>
					<li><a href="?c=nouveau" title="AccessKey: g" accesskey="g">contemporary nouveau</a> by <a href="http://www.monc.se/" class="c">David Hellsing</a>&nbsp;</li>
					<li><a href="?c=teatime" title="AccessKey: h" accesskey="h">Teatime</a> by <a href="http://members.chello.at/michaela.sampl/" class="c">Michaela Maria Sampl</a>&nbsp;</li>
					<li><a href="?c=cnote" title="AccessKey: i" accesskey="i">C-Note</a> by <a href="http://www.ploughdeep.com/" class="c">Brian Williams</a>&nbsp;</li>
					<li><a href="?c=ninja" title="AccessKey: j" accesskey="j">table layout assassination!</a> by <a href="http://web.burza.hr/" class="c">marko krsul & marko dugonjic</a>&nbsp;</li>
					<li><a href="?c=movies" title="AccessKey: k" accesskey="k">Retro Theater</a> by <a href="http://space-sheeps.info/" class="c">ERIC ROGé</a>&nbsp;</li>
				</ul>
			</div>

			<div id="larchives">
				<h3 class="archives"><span>Archives:</span></h3>
				<ul>
				</ul>
			</div>
			
			<div id="lresources">
				<h3 class="resources"><span>Resources:</span></h3>
				<ul>
					<li><a href="http://www.csszengarden.com" title="Check out CSS Zen Garden for more themes!" accesskey="c"><acronym title="Cascading Style Sheets"><span class="accesskey">C</span>SS</acronym> Zen Garden</a></li>
					<li><a href="http://www.puremvc.org" title="Read more on PureMVC" accesskey="p">PureMVC</a></li>
					<li><a href="http://www.php.net" title="Read more about PHP" accesskey="h">PHP</a></li>
					<li><a href="http://www.mamp.info/en/index.php" title="Read more about MAMP" accesskey="h">MAMP: Personal Server for Mac</a></li>
					<li><a href="http://www.apachefriends.org/en/xampp.html" title="Read more about XAMP" accesskey="h">XAMP: Personal Server for Windows</a></li>
				</ul>
			</div>
		</div>
	</div>


</div>

<!-- These extra divs/spans may be used as catch-alls to add extra imagery. -->
<!-- Add a background image to each and use width and height to control sizing, place with absolute positioning -->
<div id="extraDiv1"><span></span></div><div id="extraDiv2"><span></span></div><div id="extraDiv3"><span></span></div>
<div id="extraDiv4"><span></span></div><div id="extraDiv5"><span></span></div><div id="extraDiv6"><span></span></div>

</body>
</html>