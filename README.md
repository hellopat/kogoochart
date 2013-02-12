kogoochart
==========

Create Google Charts on the server with the Kohana Libary

Kogoochart is a library built specifically for the Kohana PHP framework to utilize the Google Chart API.

= Introduction =

See the in code documentation for how to use the library.  In time I will create more detailed documentation on how to use the library and each of it's functions. 


= Simple Example =

{{{
// Data
$data_1 = array('Hello' => 60, 'World' => 40);

// Create object
$google_chart_1 = Google_Chart::factory();

// Set attributes
$google_chart_1->set_attributes(array(
	'encoding'				=> 'text',
	'size'					=> array('250', '100'),
	'chart'					=> 'pie_3d',
	'data'					=> $data_1,
));

// Display the chart
echo $google_chart_1->display();
}}}

Outputs

{{{<img src="http://chart.apis.google.com/chart?chs=250x100&amp;cht=p3&amp;chd=t%3A60%2C40&amp;chm=%7C&amp;chl=Hello%7CWorld" width="250" height="100" />}}}

http://chart.apis.google.com/chart?chs=250x100&cht=p3&chd=t%3A60%2C40&chm=|&chl=Hello|World&nonsense=chart.png

= Less Simple Example =

{{{
// Data
$data_2 = array(48, 36, 20, -15, 26, 53, 60, 11, 3, 19);

// Create object
$google_chart_2 = Google_Chart::factory();

// Set attributes
$google_chart_2->set_attributes(array(
	'encoding'				=> 'text',
	'title'					=> 'My First Chart',
	'size'					=> array('500', '300'),
	'chart'					=> 'vertical_bar',
	'color'					=> array('FFDFC1'),
	'data'					=> $data_2,
	'axis_type'				=> array('x', 'y'),
	'bar_width_and_spacing'	                => 'auto',
	'data_scale'			        => 'auto',
));

// Display the chart
echo $google_chart_2->display();
}}}

Outputs

{{{<img src="http://chart.apis.google.com/chart?chs=500x300&amp;cht=bvs&amp;chd=t%3A48%2C36%2C20%2C-15%2C26%2C53%2C60%2C11%2C3%2C19&amp;chds=-15%2C60&amp;chco=FFDFC1&amp;chm=%7C&amp;chtt=My+First+Chart&amp;chxt=x%2Cy&amp;chbh=a" width="500" height="300" />}}}

http://chart.apis.google.com/chart?chs=500x300&cht=bvs&chd=t%3A48%2C36%2C20%2C-15%2C26%2C53%2C60%2C11%2C3%2C19&chds=-15%2C60&chco=FFDFC1&chm=|&chtt=My+First+Chart&chxt=x%2Cy&chbh=a&nonsense=chart.png

= Line chart example with line styles =

{{{
// Data
$data_3_1 = array(10, 20, 40, 20, 30, 50, 80, 90, 70);
$data_3_2 = array(5, 10, 15, 20, 25, 30, 35, 40, 45);

// Create object
$google_chart_3 = Google_Chart::factory();

// Set attributes
$google_chart_3->set_attributes(array(
	'encoding'				=> 'text',
	'title'					=> 'Line Chart Test',
	'size'					=> array('500', '300'),
	'chart'					=> 'line',
	'data'					=> array($data_3_1, $data_3_2),
	'axis_type'				=> array('x', 'y'),
	'bar_width_and_spacing'	                => 'auto',
	'line_style'			        => array(array('5', '2', '3'), array(1, 3, 4)),
));

// Display the chart (magical toString method)
echo $google_chart_3;
}}}

Outputs

{{{<img src="http://chart.apis.google.com/chart?chs=500x300&amp;cht=lc&amp;chd=t%3A10%2C20%2C40%2C20%2C30%2C50%2C80%2C90%2C70%7C5%2C10%2C15%2C20%2C25%2C30%2C35%2C40%2C45&amp;chm=%7C&amp;chtt=Line+Chart+Test&amp;chxt=x%2Cy&amp;chbh=a&amp;chls=5%2C2%2C3%7C1%2C3%2C4" width="500" height="300" />}}}

http://chart.apis.google.com/chart?chs=500x300&cht=lc&chd=t:10,20,40,20,30,50,80,90,70|5,10,15,20,25,30,35,40,45&chm=|&chtt=Line+Chart+Test&chxt=x,y&chbh=a&chls=5,2,3|1,3,4&nonsense=chart.png
