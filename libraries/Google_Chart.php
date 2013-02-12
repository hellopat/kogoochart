<?php defined('SYSPATH') or die('No direct access allowed.');

/**
 * Google Chart Library
 * 
 * This library handles the creating a chart using the Google Charts API.
 * 
 * Is is important to understand how Google Charts works before attempting to use
 * the more complex features.  Please review the following link:
 * 
 * http://code.google.com/apis/chart/
 * 
 * @package    Google Chart API Library
 * @author     Patrick Clark
 * @license    http://www.opensource.org/licenses/mit-license.php
 * @version    0.1
 */
class Google_Chart_Core {
﻿  
﻿  // Base URL
﻿  const URL = 'http://chart.apis.google.com/chart?';
﻿  
﻿  // Attributes
﻿  protected $chart_types = array(
﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  // Line
﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  'line' ﻿  ﻿  ﻿  ﻿  ﻿  => 'lc',
﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  'sparkline' ﻿  ﻿  ﻿  => 'ls',
﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  'line_xy'﻿  ﻿  ﻿  ﻿  => 'lxy',
﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  // Bar
﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  'horizontal_bar'﻿  ﻿  => 'bhs',
﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  'vertical_bar'﻿  ﻿  ﻿  => 'bvs',
﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  'horizontal_bar_grp'﻿  => 'bhg',
﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  'vertical_bar_grp'﻿  ﻿  => 'bvg',
﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  // Pie
﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  'pie'﻿  ﻿  ﻿  ﻿  ﻿  => 'p',
﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  'pie_3d'﻿  ﻿  ﻿  ﻿  => 'p3',
﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  'pie_concentric'﻿  ﻿  => 'pc',
﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  // Venn
﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  'venn'﻿  ﻿  ﻿  ﻿  ﻿  => 'v',
﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  // Scatter
﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  'scatter'﻿  ﻿  ﻿  ﻿  => 's',
﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  // Radar
﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  'radar'﻿  ﻿  ﻿  ﻿  ﻿  => 'r',
﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  'radar_fill'﻿  ﻿  ﻿  => 'rs',
﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  // Maps
﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  'map'﻿  ﻿  ﻿  ﻿  ﻿  => 't',
﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  // Google-o-meter
﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  'google_o_meter'﻿  ﻿  => 'gom',
﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  // QR
﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  'qr'﻿  ﻿  ﻿  ﻿  ﻿  => 'qr',
﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  );
﻿  protected $encoding_types = array(
﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  'text'﻿  ﻿  ﻿  ﻿  ﻿  => 't',
﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  'simple'﻿  ﻿  ﻿  ﻿  => 's',
﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  'extended'﻿  ﻿  ﻿  ﻿  => 'e',
﻿  );
﻿  protected $chart_fill_methods = array(
﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  'solid'﻿  ﻿  ﻿  ﻿  ﻿  => 's',
﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  'linear_g'﻿  ﻿  ﻿  ﻿  => 'lg',
﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  'linear_s'﻿  ﻿  ﻿  ﻿  => 'ls',
﻿  );
﻿  protected $chart_fill_types = array(
﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  'background'﻿  ﻿  ﻿  => 'bg',
﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  'chart'﻿  ﻿  ﻿  ﻿  ﻿  => 'c',
﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  'transparency'﻿  ﻿  ﻿  => 'a',
﻿  );
﻿  protected $legend_positions = array(
﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  'bottom'﻿  ﻿  ﻿  ﻿  => 'b',
﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  'top'﻿  ﻿  ﻿  ﻿  ﻿  => 't',
﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  'left'﻿  ﻿  ﻿  ﻿  ﻿  => 'l',
﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  'right'﻿  ﻿  ﻿  ﻿  ﻿  => 'r',
﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  'bottom_vertical'﻿  ﻿  => 'bv',
﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  'top_vertical'﻿  ﻿  ﻿  => 'tv',
﻿  );
﻿  protected $axis_indexes = array(
﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  'x'﻿  ﻿  ﻿  ﻿  ﻿  ﻿  => '0',
﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  'y'﻿  ﻿  ﻿  ﻿  ﻿  ﻿  => '1',
﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  'r'﻿  ﻿  ﻿  ﻿  ﻿  ﻿  => '2',
﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  't'﻿  ﻿  ﻿  ﻿  ﻿  ﻿  => '3',﻿  
﻿  );
﻿  protected $axis_alignment = array(
﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  'left'﻿  ﻿  ﻿  ﻿  ﻿  => '-1',
﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  'center'﻿  ﻿  ﻿  ﻿  => '0',
﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  'right'﻿  ﻿  ﻿  ﻿  ﻿  => '1',
﻿  );
﻿  protected $axis_drawing_control = array(
﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  'axis'﻿  ﻿  ﻿  ﻿  ﻿  => 'l',
﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  'tick'﻿  ﻿  ﻿  ﻿  ﻿  => 't',
﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  'both'﻿  ﻿  ﻿  ﻿  ﻿  => 'lt',
﻿  );
﻿  protected $data_label_type = array(
﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  'flag'﻿  ﻿  ﻿  ﻿  ﻿  => 'f',
﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  'text'﻿  ﻿  ﻿  ﻿  ﻿  => 't',
﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  'number'﻿  ﻿  ﻿  ﻿  => 'N',
﻿  );
﻿  protected $priority = array(
﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  'low'﻿  ﻿  ﻿  ﻿  ﻿  => '-1',
﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  'medium'﻿  ﻿  ﻿  ﻿  => '0',
﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  'high'﻿  ﻿  ﻿  ﻿  ﻿  => '1',
﻿  );
﻿  protected $bar_spacing_types = array(
﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  'auto'﻿  ﻿  ﻿  ﻿  ﻿  => 'a',
﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  'relative'﻿  ﻿  ﻿  ﻿  => 'r',
﻿  );
﻿  
﻿  // Parameters
﻿  protected $chart = '';
﻿  protected $size = array();
﻿  protected $encoding = 't';
﻿  protected $invis_series = '';
﻿  protected $data = array();
﻿  protected $data_scale = '';
﻿  
﻿  protected $color = '';
﻿  protected $data_fill_area = '';
﻿  protected $chart_fill_area = '';
﻿  
﻿  protected $title = '';
﻿  protected $title_params = '';
﻿  protected $legend = '';
﻿  protected $legend_position = '';
﻿  protected $label = '';
﻿  protected $axis_type = '';
﻿  protected $axis_label = array();
﻿  protected $axis_label_position = array();
﻿  protected $axis_range = array();
﻿  protected $axis_style = array();
﻿  protected $axis_tick_length = array();
﻿  protected $data_point_label = array();
﻿  
﻿  protected $bar_width_and_spacing = '';
﻿  protected $bar_zero_line = '';
﻿  protected $chart_margin = '';
﻿  protected $line_style_chls = array();
﻿  protected $line_style_chm = array();
﻿  
﻿  /**
﻿   * Create an instance of Google Chart lib.
﻿   * 
﻿   * @return object Instance
﻿   */
﻿  public static function instance()
﻿  {
﻿  ﻿  static $instance;
﻿  ﻿  
﻿  ﻿  empty($instance) and $instance = new Google_Chart();
﻿  ﻿  
﻿  ﻿  return $instance;
﻿  }
﻿  
﻿  /**
﻿   * Factory method.
﻿   * 
﻿   * @return object New object
﻿   */
﻿  public static function factory()
﻿  {
﻿  ﻿  return new Google_Chart();
﻿  }
﻿  
﻿  /**
﻿   * Sets the attributes for the chart.
﻿   * 
﻿   * @param  array Attributes ($attrs)
﻿   * @return void
﻿   */
﻿  public function set_attributes($attrs)
﻿  {
﻿  ﻿  if (is_array($attrs))
﻿  ﻿  {
﻿  ﻿  ﻿  foreach ($attrs as $k => $v)
﻿  ﻿  ﻿  {
﻿  ﻿  ﻿  ﻿  $this->{"set_$k"}($v);
﻿  ﻿  ﻿  }
﻿  ﻿  }
﻿  ﻿  else
﻿  ﻿  {
﻿  ﻿  ﻿  throw new Kohana_User_Exception('Array expected', 'Attributes must be passed as an associative array.');
﻿  ﻿  }
﻿  }
﻿  
﻿  /**
﻿   * Sets the chart type.
﻿   * 
﻿   * @param  string Chart type ($chart)
﻿   * @return void
﻿   */
﻿  public function set_chart($chart)
﻿  {
﻿  ﻿  if (is_string($chart))
﻿  ﻿  {
﻿  ﻿  ﻿  // Index checks
﻿  ﻿  ﻿  $this->check_index($chart, 'chart_types');
﻿  ﻿  ﻿  $this->chart = $chart;
﻿  ﻿  }
﻿  ﻿  else
﻿  ﻿  {
﻿  ﻿  ﻿  throw new Kohana_User_Exception('String expected', 'Chart type must be a string.');
﻿  ﻿  }
﻿  }
﻿  
﻿  /**
﻿   * Returns the chart type.
﻿   * 
﻿   * @return string Type
﻿   */
﻿  protected function get_type()
﻿  {
﻿  ﻿  return $this->chart;
﻿  }
﻿  
﻿  /**
﻿   * Sets the chart title.
﻿   * 
﻿   * Use a pipe character (|) to force a line break.
﻿   * 
﻿   * @param  string Chart title ($title)
﻿   * @return void
﻿   */
﻿  public function set_title($title)
﻿  {
﻿  ﻿  if (is_string($title))
﻿  ﻿  {
﻿  ﻿  ﻿  $this->title = $title;
﻿  ﻿  }
﻿  ﻿  else
﻿  ﻿  {
﻿  ﻿  ﻿  throw new Kohana_User_Exception('String expected', 'Chart title must be a string.');
﻿  ﻿  }
﻿  }
﻿  
﻿  /**
﻿   * Returns the chart title.
﻿   * 
﻿   * @return string Chart title
﻿   */
﻿  protected function get_title()
﻿  {
﻿  ﻿  return $this->title;
﻿  }
﻿  
﻿  /**
﻿   * Sets the chart titles' attributes.
﻿   * 
﻿   * <color> is the chart title color.
﻿   * <font size> is the chart title font size.
﻿   * 
﻿   * @todo   Add checks to array params to ensure user is properly using function.
﻿   * @param  array  Chart title params ($title_params)
﻿   * @return void
﻿   */
﻿  public function set_title_attrs($title_params)
﻿  {
﻿  ﻿  if (is_array($title_params))
﻿  ﻿  {
﻿  ﻿  ﻿  $this->title_params = implode(',', $title_params);
﻿  ﻿  }
﻿  ﻿  else
﻿  ﻿  {
﻿  ﻿  ﻿  throw new Kohana_User_Exception('Array expected', 'Chart title attributes must be an array.');
﻿  ﻿  }
﻿  }
﻿  
﻿  /**
﻿   * Gets the chart titles' attributes.
﻿   * 
﻿   * @return string Chart title attributes
﻿   */
﻿  protected function get_title_attrs()
﻿  {
﻿  ﻿  return $this->title_params;
﻿  }
﻿  
﻿  /**
﻿   * Sets the chart label.
﻿   * 
﻿   * <label 1 value>..<label n value> are the chart label values.
﻿   * 
﻿   * You can specify missing labels by using an empty string in the array.
﻿   * 
﻿   * Note: This sets the label for pie charts, the google-o-meter, and 
﻿   * the x-axis for other charts only.
﻿   * 
﻿   * When specifying the size of your chart with chs, consider how long your labels are.
﻿   * 
﻿   * Generally, a two-dimensional pie chart needs to be approximately twice as wide
﻿   * as it is high, and a three dimensional pie chart needs to be approximately two
﻿   * and a half times wider than it is high, to display labels properly.
﻿   * 
﻿   * @param  array / string Chart label ($label)
﻿   * @return void
﻿   */
﻿  public function set_label($label)
﻿  {
﻿  ﻿  if (is_array($label))
﻿  ﻿  {
﻿  ﻿  ﻿  $this->label = implode('|', $label);
﻿  ﻿  }
﻿  ﻿  else
﻿  ﻿  {
﻿  ﻿  ﻿  $this->label = $label;
﻿  ﻿  }
﻿  }
﻿  
﻿  /**
﻿   * Returns the chart label.
﻿   * 
﻿   * @return string Label
﻿   */
﻿  protected function get_label()
﻿  {
﻿  ﻿  return $this->label;
﻿  }
﻿  
﻿  /**
﻿   * Sets the chart legend.
﻿   * 
﻿   * Specify labels in the same order as your data sets.
﻿   * The legend will use the same colors as your chart uses.
﻿   * 
﻿   * @param  array / string Legend ($legend)
﻿   * @return void
﻿   */
﻿  public function set_legend($legend)
﻿  {
﻿  ﻿  if (is_array($legend))
﻿  ﻿  {
﻿  ﻿  ﻿  $this->legend = implode('|', $legend);
﻿  ﻿  }
﻿  ﻿  else
﻿  ﻿  {
﻿  ﻿  ﻿  $this->legend = $legend;
﻿  ﻿  }
﻿  }
﻿  
﻿  /**
﻿   * Returns the chart legend.
﻿   * 
﻿   * @return string Legend
﻿   */
﻿  protected function get_legend()
﻿  {
﻿  ﻿  return $this->legend;
﻿  }
﻿  
﻿  /**
﻿   * Sets the chart legend position.
﻿   * 
﻿   * This function depends on whether the legend is set to specify the legend's position.
﻿   * 
﻿   * To draw the legend in a horizontal row, use one of the following options:
﻿   * ﻿  ﻿  'bottom' places the legend at the bottom of the chart.
﻿   * ﻿  ﻿  'top' places the legend at the top of the chart.
﻿   * To draw the legend in a vertical column, use one of the following options:
﻿   * ﻿  ﻿  'bottom_vertical' places the legend at the bottom of the chart.
﻿   * ﻿  ﻿  'top_vertical' places the legend at the top of the chart.
﻿   * ﻿  ﻿  'right' places the legend to the right of the chart.
﻿   * ﻿  ﻿  'left' places the legend to the left of the chart.
﻿   * 
﻿   * @param  string Legend position ($legend_position)
﻿   * @return void
﻿   */
﻿  public function set_legend_position($legend_position)
﻿  {
﻿  ﻿  $this->check_index($legend_position, 'legend_positions');
﻿  ﻿  $this->legend_position = $legend_position;
﻿  }
﻿  
﻿  /**
﻿   * Returns the chart legend position.
﻿   * 
﻿   * @return  string Legend position
﻿   */
﻿  protected function get_legend_position()
﻿  {
﻿  ﻿  return $this->legend_position;
﻿  }
﻿  
﻿  /**
﻿   * Sets the chart size.
﻿   * 
﻿   * <width in pixels> is the width in pixels.
﻿   * <height in pixels> is the height in pixels.
﻿   * 
﻿   * The largest possible area for all charts except maps is 300,000 pixels. 
﻿   * As the maximum height or width is 1000 pixels, examples of maximum sizes
﻿   * are 1000x300, 300x1000, 600x500, 500x600, 800x375, and 375x800.
﻿   * 
﻿   * @param  array / string Chart size ($size)
﻿   * @return void
﻿   */
﻿  public function set_size($size)
﻿  {
﻿  ﻿  if (is_array($size))
﻿  ﻿  {
﻿  ﻿  ﻿  $this->size['width'] = (int)trim($size[0]);
﻿  ﻿  ﻿  $this->size['height'] = (int)trim($size[1]);
﻿  ﻿  }
﻿  ﻿  elseif (is_string($size))
﻿  ﻿  {
﻿  ﻿  ﻿  $size = str_replace(' ', '', $size);
﻿  ﻿  ﻿  
﻿  ﻿  ﻿  if (strpos($size, ','))
﻿  ﻿  ﻿  {
﻿  ﻿  ﻿  ﻿  $arr = explode(',', $size);
﻿  ﻿  ﻿  ﻿  $this->size['width'] = (int)$arr[0];
﻿  ﻿  ﻿  ﻿  $this->size['height'] = (int)$arr[1];
﻿  ﻿  ﻿  }
﻿  ﻿  }
﻿  ﻿  
﻿  ﻿  if ($this->size['width'] * $this->size['height'] > 300000)
﻿  ﻿  {
﻿  ﻿  ﻿  throw new Kohana_User_Exception('Chart Too Large', 'Chart size must be < 300000 pixels.');
﻿  ﻿  }
﻿  ﻿  else
﻿  ﻿  {
﻿  ﻿  ﻿  if ($this->size['height'] > 1000 OR $this->size['width'] > 1000)
﻿  ﻿  ﻿  {
﻿  ﻿  ﻿  ﻿  throw new Kohana_User_Exception('Chart Too Large', 'Chart width or height must not exceed 1000 pixels.');
﻿  ﻿  ﻿  }
﻿  ﻿  }
﻿  }
﻿  
﻿  /**
﻿   * Returns the chart size.
﻿   * 
﻿   * @return  string Size
﻿   */
﻿  protected function get_size()
﻿  {
﻿  ﻿  return implode('x', $this->size);
﻿  }
﻿  
﻿  /**
﻿   * Sets the chart data.
﻿   * 
﻿   * Data is scaled to fit the encoding range.  Data sets are floating point numbers
﻿   * from zero (0.0) to one hundred (100.0). Values less than zero are truncated,
﻿   * and considered missing values. Values above 100 are truncated to 100. Truncation
﻿   * happens before any scaling or axis labeling.
﻿   * 
﻿   * If you pass through an associative array, it will automatically set the labels to
﻿   * the last data set you pass through.
﻿   * 
﻿   * @param  array Data sets ($data)
﻿   * @return void
﻿   */
﻿  public function set_data($data)
﻿  {
﻿  ﻿  if(is_array($data))
﻿  ﻿  {
﻿  ﻿  ﻿  // Data set check
﻿  ﻿  ﻿  $this->check_data_sets($data);
﻿  ﻿  ﻿  
﻿  ﻿  ﻿  foreach($data as $key => $set)
﻿  ﻿  ﻿  {
﻿  ﻿  ﻿  ﻿  $labels = array_keys($set);
﻿  ﻿  ﻿  ﻿  
﻿  ﻿  ﻿  ﻿  // Check for labels
﻿  ﻿  ﻿  ﻿  if ($labels != range(0, count($labels) - 1))
﻿  ﻿  ﻿  ﻿  {
﻿  ﻿  ﻿  ﻿  ﻿  $this->set_label($labels);
﻿  ﻿  ﻿  ﻿  }
﻿  ﻿  ﻿  ﻿  
﻿  ﻿  ﻿  ﻿  $this->data[] = implode(',', $set);
﻿  ﻿  ﻿  }
﻿  ﻿  }
﻿  ﻿  else
﻿  ﻿  {
﻿  ﻿  ﻿  $this->data[] = $data;
﻿  ﻿  }
﻿  }
﻿  
﻿  /**
﻿   * Encodes and returns the data.
﻿   * 
﻿   * This function relies on the text encoding, so if you want to encode the data
﻿   * differently than plain text (default) you must specify the encoding type before
﻿   * you display.
﻿   * 
﻿   * @return string Data sets
﻿   */
﻿  protected function get_data()
﻿  {
﻿  ﻿  if ($this->encoding == 't')
﻿  ﻿  {
﻿  ﻿  ﻿  return implode('|', $this->data);
﻿  ﻿  }
﻿  ﻿  
﻿  ﻿  $simple_encoding = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
﻿  ﻿  $extended_encoding = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789-.';
﻿  ﻿  
﻿  ﻿  $encoded_data = array();
﻿  ﻿  
﻿  ﻿  for ($i = 0; $i < count($this->data); $i++)
﻿  ﻿  {
﻿  ﻿  ﻿  $encoded_data[$i] = array();
﻿  ﻿  ﻿  
﻿  ﻿  ﻿  $data_array[$i] = explode(',', $this->data[$i]);
﻿  ﻿  ﻿  
﻿  ﻿  ﻿  $max_val = max($data_array[$i]);
﻿  ﻿  ﻿  
﻿  ﻿  ﻿  for ($j = 0; $j < count($data_array[$i]); $j++)
﻿  ﻿  ﻿  {
﻿  ﻿  ﻿  ﻿  $current_val = $data_array[$i][$j];
﻿  ﻿  ﻿  ﻿  
﻿  ﻿  ﻿  ﻿  if ($this->encoding == 's')
﻿  ﻿  ﻿  ﻿  {
﻿  ﻿  ﻿  ﻿  ﻿  if (is_numeric($current_val) AND (float)$current_val >= 0)
﻿  ﻿  ﻿  ﻿  ﻿  {
﻿  ﻿  ﻿  ﻿  ﻿  ﻿  $str_pos = round((strlen($simple_encoding) - 1) * (float)$current_val / $max_val);
﻿  ﻿  ﻿  ﻿  ﻿  ﻿  
﻿  ﻿  ﻿  ﻿  ﻿  ﻿  array_push($encoded_data[$i], substr($simple_encoding, $str_pos, 1));
﻿  ﻿  ﻿  ﻿  ﻿  }
﻿  ﻿  ﻿  ﻿  ﻿  else
﻿  ﻿  ﻿  ﻿  ﻿  {
﻿  ﻿  ﻿  ﻿  ﻿  ﻿  array_push($encoded_data[$i], '_');
﻿  ﻿  ﻿  ﻿  ﻿  }
﻿  ﻿  ﻿  ﻿  }
﻿  ﻿  ﻿  ﻿  else
﻿  ﻿  ﻿  ﻿  {
﻿  ﻿  ﻿  ﻿  ﻿  $new_val = ((4095 * (float)$current_val) / $max_val);
﻿  ﻿  ﻿  ﻿  ﻿  
﻿  ﻿  ﻿  ﻿  ﻿  $char_1 = floor($new_val / 64);
﻿  ﻿  ﻿  ﻿  ﻿  $char_2 = $new_val % 64;
﻿  ﻿  ﻿  ﻿  ﻿  
﻿  ﻿  ﻿  ﻿  ﻿  array_push($encoded_data[$i], substr($extended_encoding, $char_1, 1) . substr($extended_encoding, $char_2, 1));
﻿  ﻿  ﻿  ﻿  }
﻿  ﻿  ﻿  }
﻿  ﻿  ﻿  
﻿  ﻿  ﻿  $encoded_data[$i] = implode('', $encoded_data[$i]);
﻿  ﻿  }
﻿  ﻿  
﻿  ﻿  return implode(',', $encoded_data);
﻿  }
﻿  
﻿  /**
﻿   * Sets the data scale.
﻿   * 
﻿   * A set of one or more minimum and maximum allowable values for each data series. 
﻿   * If you supply fewer data scaling parameters than there are data sets, the last
﻿   * scaling parameter is applied to the remaining data sets. Provide just one pair
﻿   * of scaling parameters to apply a single range to a chart.
﻿   * <data set 1 minimum value> is the minimum allowable value in the first data set. Lower values are marked as missing.
﻿   * <data set 1 maximum value> is the maximum allowable value in the first data set. Higer values are truncated to this value.
﻿   * <data set n minimum value> is the minimum allowable value in the nth data set. Lower values are marked as missing.
﻿   * <data set n maximum value> is the maximum allowable value in the nth data set. Higher values are truncated to this value.
﻿   * 
﻿   * This function also has the ability to auto scale the data.
﻿   * <auto> allows for auto data scaling.
﻿   * ﻿  ﻿  'auto' to allow for auto data scaling.
﻿   * <*scaling type> is used for multiple data sets.
﻿   * ﻿  ﻿  'combined' to scale the data relative to the minimum and maximum value of the combined data sets.
﻿   * ﻿  ﻿  'separate' to scale the data relative to the minimum and maximum value of each separate data set.
﻿   * 
﻿   * @param  array / string Scaling sets ($data_scale)
﻿   * @return void
﻿   */
﻿  public function set_data_scale($data_scale)
﻿  {
﻿  ﻿  // Defaults to 'separate' auto scaling.
﻿  ﻿  if (is_string($data_scale) && $data_scale == 'auto')
﻿  ﻿  {
﻿  ﻿  ﻿  $data_scale = array($data_scale, 'separate');
﻿  ﻿  }
﻿  ﻿  
﻿  ﻿  if (is_array($data_scale))
﻿  ﻿  {
﻿  ﻿  ﻿  if ($data_scale[0] == 'auto')
﻿  ﻿  ﻿  {
﻿  ﻿  ﻿  ﻿  if ($this->encoding == 't')
﻿  ﻿  ﻿  ﻿  {
﻿  ﻿  ﻿  ﻿  ﻿  if (!empty($this->data))
﻿  ﻿  ﻿  ﻿  ﻿  {
﻿  ﻿  ﻿  ﻿  ﻿  ﻿  foreach ($this->data as $key => $set)
﻿  ﻿  ﻿  ﻿  ﻿  ﻿  {
﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  $data = explode(',', $set);
﻿  ﻿  ﻿  ﻿  ﻿  ﻿  
﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  $max_val[$key] = max($data);
﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  $min_val[$key] = min($data);
﻿  ﻿  ﻿  ﻿  ﻿  ﻿  }
﻿  ﻿  ﻿  ﻿  ﻿  
﻿  ﻿  ﻿  ﻿  ﻿  ﻿  if ($data_scale[1] == 'separate')
﻿  ﻿  ﻿  ﻿  ﻿  ﻿  {
﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  for ($i = 0; $i < count($this->data); $i++)
﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  {
﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  $scale[$i] = $min_val[$i] . ',' . $max_val[$i];
﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  }
﻿  ﻿  ﻿  ﻿  ﻿  ﻿  }
﻿  ﻿  ﻿  ﻿  ﻿  ﻿  elseif ($data_scale[1] == 'combined')
﻿  ﻿  ﻿  ﻿  ﻿  ﻿  {
﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  $scale['min'] = 0;
﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  $scale['max'] = 0;
﻿  ﻿  ﻿  ﻿  ﻿  ﻿  
﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  for ($i = 0; $i < count($this->data); $i++)
﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  {
﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  $scale['min'] += $min_val[$i];
﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  $scale['max'] += $max_val[$i];
﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  }
﻿  ﻿  ﻿  ﻿  ﻿  ﻿  }
﻿  ﻿  ﻿  ﻿  ﻿  ﻿  else
﻿  ﻿  ﻿  ﻿  ﻿  ﻿  {
﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  throw new Kohana_User_Exception('Unknown value', "Please supply 'combined' or 'separate' as the scaling type.");
﻿  ﻿  ﻿  ﻿  ﻿  ﻿  }
﻿  ﻿  ﻿  ﻿  ﻿  
﻿  ﻿  ﻿  ﻿  ﻿  ﻿  $this->data_scale = implode(',', $scale);
﻿  ﻿  ﻿  ﻿  ﻿  }
﻿  ﻿  ﻿  ﻿  ﻿  else
﻿  ﻿  ﻿  ﻿  ﻿  {
﻿  ﻿  ﻿  ﻿  ﻿  ﻿  throw new Kohana_User_Exception('No data found', 'Please set the data to allow for automatic data scaling.');
﻿  ﻿  ﻿  ﻿  ﻿  }
﻿  ﻿  ﻿  ﻿  }
﻿  ﻿  ﻿  ﻿  else
﻿  ﻿  ﻿  ﻿  {
﻿  ﻿  ﻿  ﻿  ﻿  throw new Kohana_User_Exception('Scaling not supported for this encoding type', 'Encoding not supported for encoding type, ' .
$this->encoding);
﻿  ﻿  ﻿  ﻿  }
﻿  ﻿  ﻿  }
﻿  ﻿  ﻿  else
﻿  ﻿  ﻿  {
﻿  ﻿  ﻿  ﻿  $this->data_scale = implode(',', $data_scale);
﻿  ﻿  ﻿  }
﻿  ﻿  }
﻿  ﻿  else
﻿  ﻿  {
﻿  ﻿  ﻿  throw new Kohana_User_Exception('Unknown value', "Please supply 'auto' to allow for automatic data scaling, otherwise supply min
/ max values for each data set as an array.");
﻿  ﻿  }
﻿  }
﻿  
﻿  /**
﻿   * Returns the data scale.
﻿   * 
﻿   * @return string Data scale
﻿   */
﻿  protected function get_data_scale()
﻿  {
﻿  ﻿  return $this->data_scale;
﻿  }
﻿  
﻿  /**
﻿   * Sets the axis type.
﻿   * 
﻿   * <axis 1>..<axis n> are the axis types to be displayed.
﻿   * 
﻿   * x: x-axis
﻿   * y: y-axis
﻿   * t: top x-axis
﻿   * r: right y-axis
﻿   * 
﻿   * As an array: array('x','t','y','r')
﻿   * As a string: 'x, y, t, r'
﻿   * 
﻿   * @param  array Axis type ($axis_type)
﻿   * @return void
﻿   */
﻿  public function set_axis_type($axis_type)
﻿  {
﻿  ﻿  if (is_array($axis_type))
﻿  ﻿  {
﻿  ﻿  ﻿  $this->axis_type = implode(',', $axis_type);
﻿  ﻿  }
﻿  ﻿  else
﻿  ﻿  {
﻿  ﻿  ﻿  $this->axis_type = str_replace(' ', '', $axis_type);
﻿  ﻿  }
﻿  }
﻿  
﻿  /**
﻿   * Returns the axis type.
﻿   * 
﻿   * @return string Axis type
﻿   */
﻿  protected function get_axis_type()
﻿  {
﻿  ﻿  return $this->axis_type;
﻿  }
﻿  
﻿  /**
﻿   * Sets the axis labels.
﻿   * 
﻿   * <axis index> is the axis index you want the labels to be displayed on.
﻿   * <label 1>..<label n> are the actual labels.
﻿   * 
﻿   * The first label specified is placed at the start of the axis,
﻿   * and the last label specified is placed at the end of the axis.
﻿   * Other labels are uniformly spaced between the first label and
﻿   * the last label.
﻿   * 
﻿   * @param  array Axis label params ($axis_label_params)
﻿   * @return void
﻿   */
﻿  public function set_axis_label($axis_label_params)
﻿  {
﻿  ﻿  if(is_array($axis_label_params))
﻿  ﻿  {
﻿  ﻿  ﻿  // Data set check
﻿  ﻿  ﻿  $this->check_data_sets($axis_label_params);
﻿  ﻿  ﻿  
﻿  ﻿  ﻿  foreach($axis_label_params as $key => $value)
﻿  ﻿  ﻿  {
﻿  ﻿  ﻿  ﻿  // Index checks
﻿  ﻿  ﻿  ﻿  $this->check_index($value[0], 'axis_indexes');
﻿  ﻿  ﻿  ﻿  $axis_index = $value[0];
﻿  ﻿  ﻿  ﻿  unset($value[0]);
﻿  ﻿  ﻿  ﻿  
﻿  ﻿  ﻿  ﻿  $this->axis_label[] = $axis_index . ':|' . implode('|', $value);
﻿  ﻿  ﻿  }
﻿  ﻿  }
﻿  ﻿  else
﻿  ﻿  {
﻿  ﻿  ﻿  throw new Kohana_User_Exception('Array expected', 'Axis labels must be an array.');
﻿  ﻿  }
﻿  }
﻿  
﻿  /**
﻿   * Returns the axis labels.
﻿   * 
﻿   * @return  string Axis labels
﻿   */
﻿  protected function get_axis_label()
﻿  {
﻿  ﻿  return implode('|', $this->axis_label);
﻿  }
﻿  
﻿  /**
﻿   * Sets the axis label positions.
﻿   * 
﻿   * <axis index> is the axis index you want the labels to be positioned on.
﻿   * <label 1 position>..<label n position> the actual label positions.
﻿   * 
﻿   * Labels with a specified position of 0 are placed at the bottom of the y- or r-axis, 
﻿   * or at the left of the x- or t-axis.  Labels with a specified position of 100 are 
﻿   * placed at the top of the y- or r-axis, or at the right of the x- or t-axis.
﻿   * 
﻿   * @param  array Axis label positions ($axis_label_pos_params)
﻿   * @return void
﻿   */
﻿  public function set_axis_label_position($axis_label_pos_params)
﻿  {
﻿  ﻿  if(is_array($axis_label_pos_params))
﻿  ﻿  {
﻿  ﻿  ﻿  // Data set check
﻿  ﻿  ﻿  $this->check_data_sets($axis_label_pos_params);
﻿  ﻿  ﻿  
﻿  ﻿  ﻿  foreach($axis_label_pos_params as $key => $value)
﻿  ﻿  ﻿  {
﻿  ﻿  ﻿  ﻿  // Index checks
﻿  ﻿  ﻿  ﻿  $this->check_index($value[0], 'axis_indexes');
﻿  ﻿  ﻿  ﻿  
﻿  ﻿  ﻿  ﻿  $this->axis_label_position[] = implode(',', $value);
﻿  ﻿  ﻿  }
﻿  ﻿  }
﻿  ﻿  else
﻿  ﻿  {
﻿  ﻿  ﻿  throw new Kohana_User_Exception('Array expected', 'Axis label positions must be an array.');
﻿  ﻿  }
﻿  }
﻿  
﻿  /**
﻿   * Returns the axis label positions.
﻿   * 
﻿   * @return  string Axis label positions
﻿   */
﻿  protected function get_axis_label_position()
﻿  {
﻿  ﻿  return implode('|', $this->axis_label_position);
﻿  }
﻿  
﻿  /**
﻿   * Specifies a range for axis labels.
﻿   * 
﻿   * <axis index> is the axis index you want to specify a range for.
﻿   * <start of range> is the minimum range value.
﻿   * <end of range> is the maximum range value.
﻿   * <*interval> is the interval you want the labels to be separated by.
﻿   * 
﻿   * Each axis has a defined range. Because no labels or positions are specified,
﻿   * values are taken from the given range, and are evenly spaced within that range.
﻿   * In the line chart, values are evenly spread along the x-axis. In the bar chart, 
﻿   * a value is centered beneath each bar.
﻿   * 
﻿   * @param  array  Axis range ($axis_range)
﻿   * @return void
﻿   */
﻿  public function set_axis_range($axis_range)
﻿  {
﻿  ﻿  if(is_array($axis_range))
﻿  ﻿  {
﻿  ﻿  ﻿  // Data set check
﻿  ﻿  ﻿  $this->check_data_sets($axis_range);
﻿  ﻿  ﻿  
﻿  ﻿  ﻿  foreach($axis_range as $key => $value)
﻿  ﻿  ﻿  {
﻿  ﻿  ﻿  ﻿  $this->check_index($value[0], 'axis_indexes');
﻿  ﻿  ﻿  ﻿  
﻿  ﻿  ﻿  ﻿  $this->axis_range[] = implode(',', $value);
﻿  ﻿  ﻿  }
﻿  ﻿  }
﻿  ﻿  else
﻿  ﻿  {
﻿  ﻿  ﻿  throw new Kohana_User_Exception('Array expected', 'Axis range must be an array.');
﻿  ﻿  }
﻿  }
﻿  
﻿  /**
﻿   * Returns the axis range.
﻿   * 
﻿   * @return  string Axis range
﻿   */
﻿  protected function get_axis_range()
﻿  {
﻿  ﻿  return implode('|', $this->axis_range);
﻿  }
﻿  
﻿  /**
﻿   * Specify font size, color, and alignment for axis labels.
﻿   * 
﻿   * <axis index> is the axis index as specified.
﻿   * <axis color> is an RRGGBB format hexadecimal number.
﻿   * <*font size> specifies the font size in pixels.
﻿   * <*alignment> is one of the following:
﻿   * ﻿  ﻿  'left' to make the axis labels left-aligned.
﻿   * ﻿  ﻿  'center' to make the axis labels centered.
﻿   * ﻿  ﻿  'right' to make the axis labels right-aligned.
﻿   * ﻿  ﻿  By default, x--axis labels and t-axis labels are centered, y-axis labels
﻿   * ﻿  ﻿  are right-aligned, and r-axis labels are left-aligned.
﻿   * <*drawing control> is one of the following:
﻿   * ﻿  ﻿  'axis' to draw axis lines only.
﻿   * ﻿  ﻿  'tick' to draw tick marks only.
﻿   * ﻿  ﻿  'both' to draw axis lines and tick marks.
﻿   * 
﻿   * @param  array Axis style parameters ($axis_style_params)
﻿   * @return void
﻿   */
﻿  public function set_axis_style($axis_style_params)
﻿  {
﻿  ﻿  if(is_array($axis_style_params))
﻿  ﻿  {
﻿  ﻿  ﻿  // Data set check
﻿  ﻿  ﻿  $this->check_data_sets($axis_style_params);
﻿  ﻿  ﻿  
﻿  ﻿  ﻿  foreach($axis_style_params as $key => $value)
﻿  ﻿  ﻿  {
﻿  ﻿  ﻿  ﻿  // Index checks
﻿  ﻿  ﻿  ﻿  $this->check_index($value[0], 'axis_indexes');
﻿  ﻿  ﻿  ﻿  $this->check_index($value[3], 'axis_alignment');
﻿  ﻿  ﻿  ﻿  $this->check_index($value[4], 'axis_drawing_control');
﻿  ﻿  ﻿  ﻿  
﻿  ﻿  ﻿  ﻿  $this->axis_style[] = implode(',', $value);
﻿  ﻿  ﻿  }
﻿  ﻿  }
﻿  ﻿  else
﻿  ﻿  {
﻿  ﻿  ﻿  throw new Kohana_User_Exception('Array expected', 'Axis label positions must be an array.');
﻿  ﻿  }
﻿  }
﻿  
﻿  /**
﻿   * Returns the axis style.
﻿   * 
﻿   * @return  string Axis style
﻿   */
﻿  protected function get_axis_style()
﻿  {
﻿  ﻿  return implode('|', $this->axis_style);
﻿  }
﻿  
﻿  /**
﻿   * Specifies the length of tick marks.
﻿   * 
﻿   * <axis index> is the axis index as specified.
﻿   * <length of tick mark> is the 
﻿   * 
﻿   * Positive values are drawn outside the chart area. The maximum positive value is 25.
﻿   * Negative values are drawn inside the chart area.
﻿   * 
﻿   * Use this feature to draw gridlines on a chart.
﻿   * 
﻿   * @param  array Axis tick length parameters ($axis_tick_length_params)
﻿   * @return void
﻿   */
﻿  public function set_axis_tick_length($axis_tick_length_params)
﻿  {
﻿  ﻿  if(is_array($axis_tick_length_params))
﻿  ﻿  {
﻿  ﻿  ﻿  // Data set check
﻿  ﻿  ﻿  $this->check_data_sets($axis_tick_length_params);
﻿  ﻿  ﻿  
﻿  ﻿  ﻿  foreach($axis_tick_length_params as $key => $value)
﻿  ﻿  ﻿  {
﻿  ﻿  ﻿  ﻿  $this->check_index($value[0], 'axis_indexes');
﻿  ﻿  ﻿  ﻿  $this->axis_tick_length[] = implode(',', $value);
﻿  ﻿  ﻿  }
﻿  ﻿  }
﻿  ﻿  else
﻿  ﻿  {
﻿  ﻿  ﻿  throw new Kohana_User_Exception('Array expected', 'Axis tick length must be an array.');
﻿  ﻿  }
﻿  }
﻿  
﻿  /**
﻿   * Returns the axis tick length.
﻿   * 
﻿   * @return string Axis tick length
﻿   */
﻿  protected function get_axis_tick_length()
﻿  {
﻿  ﻿  return implode('|', $this->axis_tick_length);
﻿  }
﻿  
﻿  /**
﻿   * Add labels to data points on line charts, bar charts, radar charts, and scatter plots.
﻿   * 
﻿   * <label type> is one of the following characters:
﻿   * ﻿  ﻿  'flag' creates a flag.
﻿   * ﻿  ﻿  'text' creates plain text.
﻿   * ﻿  ﻿  'number' creates a number.
﻿   * <label contents> is the text of the label, for flag and text labels.
﻿   * <color> is an RRGGBB format hexadecimal number.
﻿   * <data set index> is the index of the data set on which to draw the 
﻿   * ﻿  ﻿  label. The data set index is 0 for the first data set, 1 for the second data set, and so on.
﻿   * <data point> is a floating point value that specifies the data point on which the label will be drawn. Use one of the following formats:
﻿   * ﻿  ﻿  '0' to draw a label on the first data point, 1 to draw a label on the second data point, and so on.
﻿   * ﻿  ﻿  '-1' to draw a label on each data point.
﻿   * ﻿  ﻿  '-n' to draw a label on every n-th data point.
﻿   * ﻿  ﻿  'x:y:n' to draw a label on every n-th data point in a range, where x is the first data point in
﻿   * ﻿  ﻿  ﻿  the range, and y is the last data point in the range.
﻿   * <size> is the size of the text in points.
﻿   * <*priority> is one of the following:
﻿   * ﻿  ﻿  'low' specifies that the label is drawn before all other parts of the chart. The label will
﻿   * ﻿  ﻿  ﻿  be hidden if another chart element is drawn in the same place.
﻿   * ﻿  ﻿  'medium' specifies that the label is drawn after bars or lines, but before other labels. This is the default.
﻿   * ﻿  ﻿  'high' specifies that the label is drawn after all other parts of the chart. If more than one
﻿   * ﻿  ﻿  ﻿  label has this value, the first one specified in the chm parameter will be drawn first,
﻿   * ﻿  ﻿  ﻿  the second one specified in the chm parameter will be drawn second, and so on.
﻿   * 
﻿   * If the <label type> is specified as 'number', the value of label contents must be an array, consisting of:
﻿   * 
﻿   * <number type> is one of the following:
﻿   * ﻿  ﻿  f to use a floating point number.
﻿   * ﻿  ﻿  p to use a percentage value.
﻿   * ﻿  ﻿  e to use scientific notation.
﻿   * ﻿  ﻿  c<CUR> to use a currency value.
﻿   * ﻿  ﻿  ﻿  To use a currency value, specify a three letter currency code as the value for the <CUR> parameter.
﻿   * <precision level> is an integer that specifies how many decimal places are used.
﻿   * <*z> displays trailing zeros.
﻿   * <*s> displays group separators.
﻿   * <*coordinate> specifies which coordinate to display. Use one of the following:
﻿   * ﻿  ﻿  x to display the value of the x-coordinate at the chosen data point.
﻿   * ﻿  ﻿  y to display the value of the y-coordinate at the chosen data point.
﻿   * <*before text> is the text before the data point label.
﻿   * <*after text> is the text after the data point label.
﻿   * 
﻿   * @param  array Data point label parameters ($data_point_label_params)
﻿   * @return void
﻿   */
﻿  public function set_data_point_label($data_point_label_params)
﻿  {
﻿  ﻿  if(is_array($data_point_label_params))
﻿  ﻿  {
﻿  ﻿  ﻿  // Data set check
﻿  ﻿  ﻿  $this->check_data_sets($data_point_label_params);
﻿  ﻿  ﻿  
﻿  ﻿  ﻿  foreach($data_point_label_params as $key => $value)
﻿  ﻿  ﻿  {
﻿  ﻿  ﻿  ﻿  // Index checks
﻿  ﻿  ﻿  ﻿  $this->check_index($value[0], 'data_label_type');
﻿  ﻿  ﻿  ﻿  isset($value[6]) ? $this->check_index($value[6], 'data_label_priority') : FALSE;
﻿  ﻿  ﻿  ﻿  
﻿  ﻿  ﻿  ﻿  $label_type = $value[0];
﻿  ﻿  ﻿  ﻿  $label_contents = $value[1];
﻿  ﻿  ﻿  ﻿  unset($value[0], $value[1]);
﻿  ﻿  ﻿  ﻿  
﻿  ﻿  ﻿  ﻿  // Numerical label type has a funky structure.  (See below)
﻿  ﻿  ﻿  ﻿  // <text before the number>*<number type><precision level><z><s><coordinate>*<text after the number>
﻿  ﻿  ﻿  ﻿  if ($label_type == 'N')
﻿  ﻿  ﻿  ﻿  {
﻿  ﻿  ﻿  ﻿  ﻿  if (is_array($label_contents))
﻿  ﻿  ﻿  ﻿  ﻿  {
﻿  ﻿  ﻿  ﻿  ﻿  ﻿  $number_type = $label_contents[0];      // Required
﻿  ﻿  ﻿  ﻿  ﻿  ﻿  $precision_level = $label_contents[1];  // Required
﻿  ﻿  ﻿  ﻿  ﻿  ﻿  $trailing_zeros = isset($label_contents[2]) ? $label_contents[3] : '';
﻿  ﻿  ﻿  ﻿  ﻿  ﻿  $group_separators = isset($label_contents[3]) ? $label_contents[4] : '';
﻿  ﻿  ﻿  ﻿  ﻿  ﻿  $coordinate = isset($label_contents[4]) ? $label_contents[5] : '';
﻿  ﻿  ﻿  ﻿  ﻿  ﻿  $before_text = isset($label_contents[5]) ? $label_contents[0] : '';
﻿  ﻿  ﻿  ﻿  ﻿  ﻿  $after_text = isset($label_contents[6]) ? $label_contents[6] : '';
﻿  ﻿  ﻿  ﻿  ﻿  ﻿  
﻿  ﻿  ﻿  ﻿  ﻿  ﻿  $label_contents = $before_text .
﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿    '*' .
﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿    $number_type .
﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿    $precision_level .
﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿    $trailing_zeros .
﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿    $group_separators .
﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿    $coordinate .
﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿    '*' .
﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿    $after_text;
﻿  ﻿  ﻿  ﻿  ﻿  }
﻿  ﻿  ﻿  ﻿  }
﻿  ﻿  ﻿  ﻿  
﻿  ﻿  ﻿  ﻿  $this->data_point_label[] = $label_type . $label_contents . ',' . implode(',', $value);
﻿  ﻿  ﻿  }
﻿  ﻿  }
﻿  ﻿  else
﻿  ﻿  {
﻿  ﻿  ﻿  throw new Kohana_User_Exception('Array expected', 'Axis tick length must be an array.');
﻿  ﻿  }
﻿  }
﻿  
﻿  /**
﻿   * Returns the data point labels.
﻿   * 
﻿   * @return string Data point labels
﻿   */
﻿  protected function get_data_point_label()
﻿  {
﻿  ﻿  return implode('|', $this->data_point_label);
﻿  }
﻿  
﻿  /**
﻿   * For bar charts, specifies bar thickness and spacing.
﻿   * 
﻿   * <bar width> should be specified in pixels. 
﻿   * ﻿  ﻿  'auto' instead of a pixel value to automatically resize bars. 
﻿   * ﻿  ﻿  'relative' instead of a pixel value to resize bars by using relative spacing.
﻿   * <*space between bars> and <*space between groups> should be specified in pixels.
﻿   * ﻿  ﻿  If you are using 'relative' to resize bars by using relative spacing, these values
﻿   * ﻿  ﻿  should be percentage values expressed as floating point numbers. Use 0
﻿   * ﻿  ﻿  to represent 0%, use 1.0 to represent 100%, and so on.
﻿   * 
﻿   * @param  array / string Bar width and spacing parameters ($bar_width_and_spacing_params)
﻿   * @return void
﻿   */
﻿  public function set_bar_width_and_spacing($bar_width_and_spacing_params)
﻿  {
﻿  ﻿  if (!is_array($bar_width_and_spacing_params))
﻿  ﻿  {
﻿  ﻿  ﻿  $bar_width_and_spacing_params = array($bar_width_and_spacing_params);
﻿  ﻿  }
﻿  ﻿  
﻿  ﻿  if (!is_numeric($bar_width_and_spacing_params[0]))
﻿  ﻿  {
﻿  ﻿  ﻿  // Index checks
﻿  ﻿  ﻿  $this->check_index($bar_width_and_spacing_params[0], 'bar_spacing_types');
﻿  ﻿  }
﻿  ﻿  
﻿  ﻿  $this->bar_width_and_spacing = implode(',', $bar_width_and_spacing_params);
﻿  }
﻿  
﻿  /**
﻿   * Returns the bar width and spacing.
﻿   * 
﻿   * @return string Bar width and spacing
﻿   */
﻿  protected function get_bar_width_and_spacing()
﻿  {
﻿  ﻿  return $this->bar_width_and_spacing;
﻿  }
﻿  
﻿  /**
﻿   * For bar charts, specifies a zero line.
﻿   * 
﻿   * <value between 0 and 1 for data set 1>
﻿   * <value between 0 and 1 for data set n>
﻿   * 
﻿   * These values act as a percentage relative to the entire y-axis.
﻿   * 
﻿   * Provide just one value to apply the same zero line to all data sets.
﻿   * 
﻿   * @param  array / string Bar chart zero line parameters ($bar_zero_line_params)
﻿   * @return void
﻿   */
﻿  public function set_bar_zero_line($bar_zero_line_params)
﻿  {
﻿  ﻿  if (!is_array($bar_zero_line_params))
﻿  ﻿  {
﻿  ﻿  ﻿  $bar_zero_line_params = array($bar_zero_line_params);
﻿  ﻿  }
﻿  ﻿  
﻿  ﻿  foreach ($bar_zero_line_params as $num)
﻿  ﻿  {
﻿  ﻿  ﻿  if ((float)$num < 0 OR (float)$num > 1)
﻿  ﻿  ﻿  {
﻿  ﻿  ﻿  ﻿  throw new Kohana_User_Exception('Range error', 'Please use a number between 0 and 1.');
﻿  ﻿  ﻿  }
﻿  ﻿  }
﻿  ﻿  
﻿  ﻿  $this->bar_zero_line = implode(',', $bar_zero_line_params);
﻿  }
﻿  
﻿  /**
﻿   * Returns the bar chart zero line.
﻿   * 
﻿   * @return string Bar chart zero line
﻿   */
﻿  protected function get_bar_zero_line()
﻿  {
﻿  ﻿  return $this->bar_zero_line;
﻿  }
﻿  
﻿  /**
﻿   * Specifies a chart margin.
﻿   * <left margin> sets the left margin.
﻿   * <right margin> sets the right margin.
﻿   * <top margin> sets the top margin.
﻿   * <bottom margin> sets the bottom margin.
﻿   * <*legend width> sets the legend width.
﻿   * <*legend height> sets the legend height.
﻿   * 
﻿   * All margin values specified are the minimum margins around the plot area, in pixels.
﻿   * 
﻿   * @param  array Chart margin parameters ($chart_margin_params)
﻿   * @return void
﻿   */
﻿  public function set_chart_margin($chart_margin_params)
﻿  {
﻿  ﻿  if (is_array($chart_margin_params))
﻿  ﻿  {
﻿  ﻿  ﻿  $margins = array_slice($chart_margin_params, 0, 4);
﻿  ﻿  ﻿  $legend_dims = array_slice($chart_margin_params, 4, 2);
﻿  ﻿  ﻿  
﻿  ﻿  ﻿  $this->chart_margin = implode(',', $margins) . '|' . implode(',', $legend_dims);
﻿  ﻿  }
﻿  ﻿  else
﻿  ﻿  {
﻿  ﻿  ﻿  throw new Kohana_User_Exception('Array expected', 'Chart margin must be an array.');
﻿  ﻿  }
﻿  }
﻿  
﻿  /**
﻿   * Returns the chart margin.
﻿   * 
﻿   * @return string Chart margin
﻿   */
﻿  protected function get_chart_margin()
﻿  {
﻿  ﻿  return $this->chart_margin;
﻿  }
﻿  
﻿  /**
﻿   * There are two ways to define line chart styles:
﻿   * 
﻿   * !!! First method.
﻿   * 
﻿   * <data set n line thickness>
﻿   * <length of line segment>
﻿   * <length of blank segment>
﻿   * 
﻿   * Parameter values are floating point numbers, and you can supply multiple sets of line styles.
﻿   * 
﻿   * !!! Second method.
﻿   * 
﻿   * Can be used to draw a line on a bar chart.
﻿   * 
﻿   * <color> is an RRGGBB format hexadecimal number.
﻿   * <data set index> is the index of the data set on which to draw the line. 
﻿   * ﻿  ﻿  The data set index is 0 for the first data set, 1 for the second data set, and so on.
﻿   * <data point> is a number that specifies the data point on which the line will be drawn. Use one of the following formats:
﻿   * ﻿  ﻿  0 to draw a line using all of the points in the data set.
﻿   * ﻿  ﻿  x:y to draw a line using a range of points from the data 
﻿   * ﻿  ﻿  ﻿  set. x is the first data point in the range, 
﻿   * ﻿  ﻿  ﻿  and y is the last data point in the range.
﻿   * <*size> is the width of the line in pixels.
     * <*priority> is one of the following:
﻿   * ﻿  ﻿  -1 specifies that the line is drawn before all other parts of the chart. The line will be hidden if another chart 
﻿   * ﻿  ﻿  ﻿  element is drawn in the same place.
﻿   * ﻿  ﻿  0 specifies that the line is drawn after bars or chart lines, but before other lines. This is the default.
﻿   * ﻿  ﻿  1 specifies that the line is drawn after all other parts of the chart. If more than one line has this value,
﻿   * ﻿  ﻿  ﻿  the first one specified in the chm parameter will be drawn first, the second one specified in the chm parameter
﻿   * ﻿  ﻿  ﻿  will be drawn second, and so on.
﻿   * 
﻿   * @param  array Line style parameters ($line_style_params)
﻿   * @return void
﻿   */
﻿  public function set_line_style($line_style_params)
﻿  {
﻿  ﻿  if (is_array($line_style_params))
﻿  ﻿  {
﻿  ﻿  ﻿  // Data set check
﻿  ﻿  ﻿  $this->check_data_sets($line_style_params);
﻿  ﻿  ﻿  
﻿  ﻿  ﻿  foreach($line_style_params as $key => $value)
﻿  ﻿  ﻿  {
﻿  ﻿  ﻿  ﻿  // Check which type they are using.
﻿  ﻿  ﻿  ﻿  if (is_numeric($value[0]) AND strlen((string)$value[0]) < 6)
﻿  ﻿  ﻿  ﻿  {
﻿  ﻿  ﻿  ﻿  ﻿  $this->line_style_chls[] = implode(',', $value);
﻿  ﻿  ﻿  ﻿  }
﻿  ﻿  ﻿  ﻿  else
﻿  ﻿  ﻿  ﻿  {
﻿  ﻿  ﻿  ﻿  ﻿  // Index checks
﻿  ﻿  ﻿  ﻿  ﻿  isset($value[4]) ? $this->check_index($value[4], 'priority') : FALSE;
﻿  ﻿  ﻿  ﻿  ﻿  
﻿  ﻿  ﻿  ﻿  ﻿  $this->line_style_chm[] = 'D,' . implode(',', $value);
﻿  ﻿  ﻿  ﻿  }
﻿  ﻿  ﻿  }
﻿  ﻿  }
﻿  ﻿  else
﻿  ﻿  {
﻿  ﻿  ﻿  throw new Kohana_User_Exception('Array expected', 'Axis label positions must be an array.');
﻿  ﻿  }
﻿  }
﻿  
﻿  /**
﻿   * Returns the line style.
﻿   * 
﻿   * This function is called twice in the display function.
﻿   * Reason being is because there are two ways to set the line style,
﻿   * both having different url parameters (chls, chm).
﻿   * 
﻿   * There is logic to determine which one is which.
﻿   * 
﻿   * @param  string Parameter ($param)
﻿   * @return string Line style
﻿   */
﻿  protected function get_line_style($param)
﻿  {
﻿  ﻿  if ($param == 'chls')
﻿  ﻿  {
﻿  ﻿  ﻿  return implode('|', $this->line_style_chls);
﻿  ﻿  }
﻿  ﻿  else
﻿  ﻿  {
﻿  ﻿  ﻿  return implode('|', $this->line_style_chm);
﻿  ﻿  }
﻿  }
﻿  
﻿  /**
﻿   * Sets the encoding type.
﻿   * 
﻿   * Text encoding supports floating point numbers from 0—100, inclusive.
﻿   * Text encoding with data scaling supports any positive or negative 
﻿   * floating point number, in combination with a scaling parameter.
﻿   * 
﻿   * Simple encoding lets you specify integer values from 0—61, inclusive,
﻿   * encoded by a single alphanumeric character. This encoding results in
﻿   * the shortest data string in your URL of any of the data formats (if
﻿   * any values are greater than 9).
﻿   * 
﻿   * Extended encoding lets you specify integer values from 0—4095, inclusive,
﻿   * encoded by two alphanumeric characters. Extended encoding is best suited
﻿   * to a large chart, with a large data range.
﻿   * 
﻿   * @param  string Encoding ($encoding [optional:text])
﻿   * @return void
﻿   */
﻿  public function set_encoding($encoding = 'text')
﻿  {
﻿  ﻿  if (is_string($encoding))
﻿  ﻿  {
﻿  ﻿  ﻿  $this->check_index($encoding, 'encoding_types');
﻿  ﻿  ﻿  $this->encoding = $encoding;
﻿  ﻿  }
﻿  ﻿  else
﻿  ﻿  {
﻿  ﻿  ﻿  throw new Kohana_User_Exception('String expected', 'Encoding type must be a string.');
﻿  ﻿  }
﻿  }
﻿  
﻿  /**
﻿   * Returns the encoding type.
﻿   * 
﻿   * @return  string Encoding
﻿   */
﻿  protected function get_encoding()
﻿  {
﻿  ﻿  return $this->encoding;
﻿  }
﻿  
﻿  /**
﻿   * Draws the series up to the number you define.  If you supply
﻿   * data sets greater than the number you pass in this function,
﻿   * they will be used for positioning markers or labels.
﻿   * 
﻿   * @param  int / string Series ($series)
﻿   * @return void
﻿   */
﻿  public function set_invisible($series)
﻿  {
﻿  ﻿  $this->invis_series = $series;
﻿  }
﻿  
﻿  /**
﻿   * Returns invisible series.
﻿   * 
﻿   * @return string Series
﻿   */
﻿  protected function get_invisible()
﻿  {
﻿  ﻿  return $this->invis_series;
﻿  }
﻿  
﻿  /**
﻿   * Sets colors for series.
﻿   * 
﻿   * If you specify fewer colors than data sets, the first data set with 
﻿   * unspecified colors uses the first specified color, the second data 
﻿   * set with unspecified colors uses the second specified color, and so on.
﻿   * 
﻿   * @param  string / array Color - RRGGBB format ($color)
﻿   * @return void
﻿   */
﻿  public function set_color($colors)
﻿  {
﻿  ﻿  if (is_array($colors))
﻿  ﻿  {
﻿  ﻿  ﻿  foreach ($colors as $color)
﻿  ﻿  ﻿  {
﻿  ﻿  ﻿  ﻿  if (is_array($color))
﻿  ﻿  ﻿  ﻿  {
﻿  ﻿  ﻿  ﻿  ﻿  $this->color[] = implode('|', $color);
﻿  ﻿  ﻿  ﻿  }
﻿  ﻿  ﻿  ﻿  else
﻿  ﻿  ﻿  ﻿  {
﻿  ﻿  ﻿  ﻿  ﻿  $this->color[] = $color;
﻿  ﻿  ﻿  ﻿  }
﻿  ﻿  ﻿  }
﻿  ﻿  ﻿  
﻿  ﻿  ﻿  $this->color = implode(',', $this->color);
﻿  ﻿  }
﻿  ﻿  else
﻿  ﻿  {
﻿  ﻿  ﻿  $this->color = $colors;
﻿  ﻿  }
﻿  }
﻿  
﻿  /**
﻿   * Returns colors for series.
﻿   * 
﻿   * @return  string Colors
﻿   */
﻿  protected function get_color()
﻿  {
﻿  ﻿  return $this->color;
﻿  }
﻿  
﻿  /**
﻿   * Sets the data fill area.
﻿   * 
﻿   * <color> is an RRGGBB format hexadecimal number.
﻿   * <start line index> is the index of the line at which the fill starts.
﻿   * ﻿  ﻿  The first data set specified in chd has an index of zero (0), the
﻿   * ﻿  ﻿  second data set has an index of 1, and so on.
﻿   * <end line index> is the index of the line at which the fill ends.
﻿   * ﻿  ﻿  The first data set specified in chd has an index of zero (0), the 
﻿   * ﻿  ﻿  second data set has an index of 1, and so on.
﻿   * 
﻿   * This function auto fills the <set-type>, meaning that for a single data set
﻿   * the first parameter used should be "B".  For multiple data sets, the first
﻿   * parameter used should be "b".  You can explicitly set what parameter is used,
﻿   * but that parameter must be set in ALL data sets or else the fill won't work.
﻿   * 
﻿   * For a single data sets, pass through an array, or a string.
﻿   * ﻿  ﻿  ex: array('BDC4DF', 0, 1) OR 'BCD4DF,0,1'
﻿   * For multiple data sets, pass through a multi-dimensional array.
﻿   * ﻿  ﻿  ex: array(array('BDC4DF, 0, 1), array('FDDFFD',1,2))
﻿   * 
﻿   * @param  array / string Fill area params ($fill_params)
﻿   * @return void
﻿   */
﻿  public function set_data_fill_area($fill_params)
﻿  {
﻿  ﻿  $ignore = 0;
﻿  ﻿  
﻿  ﻿  // ----Auto filling <set-type>
﻿  ﻿  // Single data set
﻿  ﻿  if ((is_array($fill_params[0]) && count($fill_params[0]) == 3 && count($fill_params) == 1))
﻿  ﻿  {
﻿  ﻿  ﻿  $fill_params[0] = array_merge(array('B'), $fill_params[0]);
﻿  ﻿  }
﻿  ﻿  // Multiple data sets
﻿  ﻿  elseif (is_array($fill_params[0]) && count($fill_params[0]) == 3 && count($fill_params) > 1)
﻿  ﻿  {
﻿  ﻿  ﻿  foreach ($fill_params as $p)
﻿  ﻿  ﻿  {
﻿  ﻿  ﻿  ﻿  $f[] = array_merge(array('b'), $p);
﻿  ﻿  ﻿  }
﻿  ﻿  ﻿  $fill_params = $f;
﻿  ﻿  }
﻿  ﻿  
﻿  ﻿  if (is_array($fill_params))
﻿  ﻿  {
﻿  ﻿  ﻿  if (count($fill_params) == 3)
﻿  ﻿  ﻿  {
﻿  ﻿  ﻿  ﻿  $fill_params = array_merge(array('B'), $fill_params);
﻿  ﻿  ﻿  }
﻿  ﻿  ﻿  
﻿  ﻿  ﻿  foreach ($fill_params as $params)
﻿  ﻿  ﻿  {
﻿  ﻿  ﻿  ﻿  if (is_array($params))
﻿  ﻿  ﻿  ﻿  {
﻿  ﻿  ﻿  ﻿  ﻿  $this->data_fill_area[] = implode(',', $params) . ',' . (string)$ignore;
﻿  ﻿  ﻿  ﻿  }
﻿  ﻿  ﻿  }
﻿  ﻿  ﻿  
﻿  ﻿  ﻿  $this->data_fill_area = is_array($this->data_fill_area) ?
﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  implode('|', $this->data_fill_area) :
﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  $this->data_fill_area = implode(',', $fill_params) . ',' . (string)$ignore;
﻿  ﻿  }
﻿  ﻿  else
﻿  ﻿  {
﻿  ﻿  ﻿  if (strpos($fill_params, 'b,') === 0 OR strpos($fill_params, 'B,') === 0)
﻿  ﻿  ﻿  {
﻿  ﻿  ﻿  ﻿  $this->data_fill_area = $fill_params . ',' . (string)$ignore;
﻿  ﻿  ﻿  }
﻿  ﻿  ﻿  else
﻿  ﻿  ﻿  {
﻿  ﻿  ﻿  ﻿  $this->data_fill_area = 'B,' . $fill_params . ',' . (string)$ignore;
﻿  ﻿  ﻿  }
﻿  ﻿  }
﻿  }
﻿  
﻿  /**
﻿   * Returns the data fill area.
﻿   * 
﻿   * @return  string Fill area
﻿   */
﻿  protected function get_data_fill_area()
﻿  {
﻿  ﻿  return $this->data_fill_area;
﻿  }
﻿  
﻿  /**
﻿   * Sets the chart fill areas.
﻿   * 
﻿   * There are three types of background fill areas:
﻿   * 1. Solid Fill, 2. Linear Gradient, 3. Linear Stripes
﻿   * Each take a different set of parameters.  This function handles
﻿   * all three fill methods.
﻿   * 
﻿   * The first parameter must be the fill type.  This can be either
﻿   * 'background', 'chart', or 'transparency'.
﻿   * The second parameter must be the fill method.  This can be either
﻿   * 'solid', 'linear_s', or 'linear_g'.
﻿   * Depending on the fill method, a different number of parameters are
﻿   * required.
﻿   * 
﻿   * Solid:
﻿   * 1.  Color - 'RRGGBB'
﻿   * Linear Stripes:
﻿   * 1.  Angle - Must be between 0 (vertical) and 90 (horizontal)
﻿   * 2.  Color - 'RRGGBB'
﻿   * 3.  Width - Must be between 0 and 1 (full width of the chart)
﻿   * Linear Gradient:
﻿   * 1.  Angle - Must be between 0 (vertical) and 90 (horizontal)
﻿   * 2.  Color - 'RRGGBB'
﻿   * 3.  Offset - Must be between 0 and 1 (specifies which color is pure,
﻿   *     1 is left most position of the chart)
﻿   * 
﻿   * @param  array Fill parameters ($fill_params)
﻿   * @return void
﻿   */
﻿  public function set_chart_fill_area($fill_params)
﻿  {
﻿  ﻿  if (is_array($fill_params))
﻿  ﻿  {
﻿  ﻿  ﻿  // Data set check
﻿  ﻿  ﻿  $this->check_data_sets($fill_params);
﻿  ﻿  ﻿  
﻿  ﻿  ﻿  foreach ($fill_params as $param)
﻿  ﻿  ﻿  {
﻿  ﻿  ﻿  ﻿  if (is_array($param))
﻿  ﻿  ﻿  ﻿  {
﻿  ﻿  ﻿  ﻿  ﻿  $this->check_index($param[0], 'chart_fill_types');
﻿  ﻿  ﻿  ﻿  ﻿  $this->check_index($param[1], 'chart_fill_methods');
﻿  ﻿  ﻿  ﻿  ﻿  
﻿  ﻿  ﻿  ﻿  ﻿  $set[] = implode(',', $param);
﻿  ﻿  ﻿  ﻿  }
﻿  ﻿  ﻿  }
﻿  ﻿  ﻿  
﻿  ﻿  ﻿  $this->chart_fill_area = implode('|', $set);
﻿  ﻿  }
﻿  ﻿  else
﻿  ﻿  {
﻿  ﻿  ﻿  throw new Kohana_User_Exception('Array expected', 'Chart fill area must be an array.');
﻿  ﻿  }
﻿  }
﻿  
﻿  /**
﻿   * Returns the chart fill area.
﻿   * 
﻿   * @return string Chart fill area
﻿   */
﻿  public function get_chart_fill_area()
﻿  {
﻿  ﻿  return $this->chart_fill_area;
﻿  }
﻿  
﻿  /**
﻿   * Outputs a raw URL string either with or without an <img> tag.
﻿   * 
﻿   * @param  bool   Display the output using an image tag ($img_tag [optional:TRUE])
﻿   * @param  array  Append attributes to the image tag ($attrs [optional:array()])
﻿   * @return string Chart image URL
﻿   */
﻿  public function display($img_tag = TRUE, $attrs = array())
﻿  {
﻿  ﻿  $this->query = array(
﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  'chs'﻿  ﻿  => $this->get_size(),
﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  'cht'﻿  ﻿  => $this->get_type(),
﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  'chd'﻿  ﻿  => $this->get_encoding() . $this->get_invisible() . ':' . $this->get_data(),
﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  'chds'﻿  ﻿  => $this->get_data_scale(),
﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  
﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  'chco'﻿  ﻿  => $this->get_color(),
﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  'chf'﻿  ﻿  => $this->get_chart_fill_area(),
﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  
﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  'chtt'﻿  ﻿  => $this->get_title(),
﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  'chts'﻿  ﻿  => $this->get_title_attrs(),
﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  'chdl'﻿  ﻿  => $this->get_legend(),
﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  'chdlp'﻿  ﻿  => $this->get_legend_position(),
﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  'chl'﻿  ﻿  => $this->get_label(),
﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  'chxt'﻿  ﻿  => $this->get_axis_type(),
﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  'chxl'﻿  ﻿  => $this->get_axis_label(),
﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  'chxp'﻿  ﻿  => $this->get_axis_label_position(),
﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  'chxr'﻿  ﻿  => $this->get_axis_range(),
﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  'chxs'﻿  ﻿  => $this->get_axis_style(),
﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  'chxtc'﻿  ﻿  => $this->get_axis_tick_length(),
﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  
﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  'chbh'﻿  ﻿  => $this->get_bar_width_and_spacing(),
﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  'chp'﻿  ﻿  => $this->get_bar_zero_line(),
﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  'chma'﻿  ﻿  => $this->get_chart_margin(),
﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿  'chls'﻿  ﻿  => $this->get_line_style('chls'),
﻿  ﻿  );
﻿  ﻿  
﻿  ﻿  $dfa = $this->get_data_fill_area();
﻿  ﻿  $dpl = $this->get_data_point_label();
﻿  ﻿  $ls = $this->get_line_style('chm');
﻿  ﻿  
﻿  ﻿  $this->query['chm'] = (!empty($dfa) ? $dfa . '|' : '') .
﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿    (!empty($dpl) ? $dpl . '|' : '') .
﻿  ﻿  ﻿  ﻿  ﻿  ﻿  ﻿    (!empty($ls) ? $ls : '');
﻿  ﻿  
﻿  ﻿  foreach ($this->query as $key => $value)
﻿  ﻿  {
﻿  ﻿  ﻿  if (empty($value))
﻿  ﻿  ﻿  {
﻿  ﻿  ﻿  ﻿  unset($this->query[$key]);
﻿  ﻿  ﻿  }
﻿  ﻿  }
﻿  ﻿  
﻿  ﻿  if ($img_tag)
﻿  ﻿  {
﻿  ﻿  ﻿  $arr = array('src' => self::URL . http_build_query($this->query), 'width' => $this->size['width'], 'height' => $this->size['height']);
﻿  ﻿  ﻿  $img_attrs = array_merge($arr, $attrs);
﻿  ﻿  ﻿  return html::image($arr);
﻿  ﻿  }
﻿  ﻿  else
﻿  ﻿  {
﻿  ﻿  ﻿  return self::URL . http_build_query($this->query);
﻿  ﻿  }
﻿  }
﻿  
﻿  /**
﻿   * Magical toString function returns the URL string to display.
﻿   * 
﻿   * Ex: echo $google_chart; --> Displays <img> tag
﻿   * 
﻿   * @return  string Chart image URL
﻿   */
﻿  public function __toString()
﻿  {
﻿  ﻿  return $this->display();
﻿  }
﻿  
﻿  /**
﻿   * Primarily for displaying a proper error message when passing an index.
﻿   * 
﻿   * @param  string  Index ($index [ref])
﻿   * @param  string  Index set ($index_set)
﻿   * @return void
﻿   */
﻿  protected function check_index(&$index, $index_set)
﻿  {
﻿  ﻿  if (array_key_exists($index, $this->{$index_set}))
﻿  ﻿  {
﻿  ﻿  ﻿  $index = $this->{$index_set}[$index];
﻿  ﻿  }
﻿  ﻿  else
﻿  ﻿  {
﻿  ﻿  ﻿  throw new Kohana_User_Exception('Index does not exist', "The index, $index, does not exist.  You may supply ["
﻿  ﻿  ﻿  . implode(', ', array_keys($this->{$index_set})) . "].");
﻿  ﻿  }
﻿  }
﻿  
﻿  /**
﻿   * Checks to see if there are multiple data sets.
﻿   * 
﻿   * @param  array  Data set ($data_set [ref])
﻿   * @return void
﻿   */
﻿  protected function check_data_sets(&$data_set)
﻿  {
﻿  ﻿  if (!isset($data_set[0]) OR !is_array($data_set[0]))
﻿  ﻿  {
﻿  ﻿  ﻿  $data_set = array($data_set);
﻿  ﻿  }
﻿  }
}