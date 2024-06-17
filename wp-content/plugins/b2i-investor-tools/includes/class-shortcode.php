<?php

/**
 * B2i Shortcode
 * @since 0.1.0
 * @package b2i
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * B2i Shortcode.
 * @since 0.1.0
 */
class B2i_Shortcode {
	
	protected $version = '1.0.7.6';
	
	/**
	 * Parent plugin class
	 * @var   class
	 * @since 0.1.0
	 */
	protected $plugin = null;

	/**
	 * Business ID option
	 * @var   string
	 * @since 0.1.0
	 */
	protected $business_id = '';

	/**
	 * Key option
	 * @var   string
	 * @since 0.1.0
	 */
	protected $key = '';
	protected $postkey = '';
	protected $ticker= '';
	/**
	***************************************************************************************************************
	 * Base URL
	 * @var   string
	 * @since 0.1.0
	***************************************************************************************************************
	*/
	 
	protected $base_http = 'https';
	protected $base_url = 'https://www.b2i.us/b2i/';
	protected $base_url2 = '://www.b2i.us/b2i/';
	protected $base_url3 = '://www.b2i.us/';
	protected $base_secdivname = 'SECdiv';
	protected $base_libdivname = 'LibDiv';
	protected $base_libviewdivname = 'LibDiv';
	protected $base_showdivname = 'ShowDiv';
	protected $base_findivname = 'LibDiv';
	protected $base_stockdivname = 'QuoteDiv';
	protected $base_codedivname = 'CodeDiv';
	protected $base_pagedivname = 'PageDiv';
	protected $base_url2_test = '://192.168.1.55/b2i/';
	protected $base_url3_test = '://192.168.1.55/';
	
	/**
	*********************************************************************************
	 * Constructor
	 *
	 * @since  0.1.0
	 * @param  object $plugin Main plugin object.
	 * @return void
	*********************************************************************************
	 */
	public function __construct( $plugin ) {
		$this->plugin = $plugin;

		add_action( 'cmb2_init', array( $this, 'setup_vars' ) );
		//add_action('cmb2_init', array( $this, 'b2i_shortcode_wp_register_scripts' ) );
		add_action( 'cmb2_init', array( $this, 'shortcodes' ) );
		
		wp_enqueue_script( 'whistleblower', plugins_url( 'b2i-investor-tools/js/wb_script.js'), array( 'jquery'), $this->version, false );
		
		//add_action( 'wp_enqueue_scripts', array( $this, 'shortcode_present_enqueue' ) );
		
		/*
		wp_enqueue_script( 'amcharts', plugins_url( 'b2i-investor-tools/js/amcharts.js'), array( 'jquery'), $this->version, false );
		wp_enqueue_script( 'serial', plugins_url( 'b2i-investor-tools/js/serial.js'), array( 'jquery'), $this->version, false );
		wp_enqueue_script( 'amstock', plugins_url( 'b2i-investor-tools/js/amstock.js'), array( 'jquery'), $this->version, false );
		wp_enqueue_script( 'export', plugins_url( 'b2i-investor-tools/js/export.js'), array( 'jquery'), $this->version, false );
		
		wp_enqueue_style('chartstyle', plugins_url('b2i-investor-tools/css/style.css'), array(), $this->version, false);
		wp_enqueue_style('export', plugins_url('b2i-investor-tools/css/export.css'), array(), $this->version, false);
		*/
	}

	
	
	/**
	*********************************************************************************
	 * Setup business id and api key variables
	 * @since  0.1.0
	 * @return void
	*********************************************************************************
	*/
	public function setup_vars() {
		$this->business_id = cmb2_get_option( 'b2i_options', 'business_id' );
		$this->key = cmb2_get_option( 'b2i_options', 'key' );
		$this->postkey = cmb2_get_option( 'b2i_options', 'postkey' );
		$this->ticker = cmb2_get_option( 'b2i_options', 'ticker' );
	}
	
	
	
	/**
	 *******************************************************************************
	 * Register scripts and styles
	 * @since  1.0.6
	 * @return void
	 ********************************************************************************
	 */
	public function b2i_shortcode_wp_register_scripts(){
		/*
		wp_register_script( 'amcharts', plugins_url( 'b2i-investor-tools/js/amcharts.js'), array( 'jquery'), $this->version, false );
		wp_register_script( 'serial', plugins_url( 'b2i-investor-tools/js/serial.js'), array( 'jquery'), $this->version, false );
		wp_register_script( 'amstock', plugins_url( 'b2i-investor-tools/js/amstock.js'), array( 'jquery'), $this->version, false );
		wp_register_script( 'export', plugins_url( 'b2i-investor-tools/js/export.js'), array( 'jquery'), $this->version, false );
		
		wp_register_style('chartstyle', plugins_url('b2i-investor-tools/css/style.css'), array(), $this->version, false);
		wp_register_style('export', plugins_url('b2i-investor-tools/css/export.css'), array(), $this->version, false);
		*/
		/*
		wp_register_script( 'amcharts5', plugins_url( 'b2i-investor-tools/js/index.js'), array( 'jquery'), $this->version, false );
		wp_register_script( 'serial5', plugins_url( 'b2i-investor-tools/js/xy.js'), array( 'jquery'), $this->version, false );
		wp_register_script( 'amstock5', plugins_url( 'b2i-investor-tools/js/stock.js'), array( 'jquery'), $this->version, false );
        wp_register_script( 'export5', plugins_url( 'b2i-investor-tools/js/exporting.js'), array( 'jquery'), $this->version, false );
		*/
		
		/*
		wp_register_script( 'highstock', plugins_url( 'b2i-investor-tools/js/highstock.js'), array( 'jquery'), $this->version, false );
        wp_register_script( 'highstock_data', plugins_url( 'b2i-investor-tools/js/data.js'), array( 'jquery'), $this->version, false );
		*/
	}



	/**
	 *******************************************************************************
	 * Enqueue scripts and styles if shortcode present
	 * @since  0.1.0
	 * @return void
	 ********************************************************************************
	 */
	public function shortcode_present_enqueue(){
		global $post;
		/*
		if ( has_shortcode( $post->post_content, 'b2i_chart4' )) {
			wp_enqueue_script( 'highstock' );
			wp_enqueue_script( 'highstock_data' );
		}
		
		
		//AmChart 5 supporting files
		if ( has_shortcode( $post->post_content, 'b2i_chart5' )) {
			wp_enqueue_script( 'amcharts5' );
			wp_enqueue_script( 'serial5' );
			wp_enqueue_script( 'amstock5' );
			wp_enqueue_script( 'export5' );
		}
		*/
		
		/*
		//AmChart 3 supporting files
		if ( has_shortcode( $post->post_content, 'b2i_chart' ) || has_shortcode( $post->post_content, 'b2i_intrachart' )) {
			wp_enqueue_script( 'amcharts' );
			wp_enqueue_script( 'serial' );
			wp_enqueue_script( 'amstock' );
			wp_enqueue_script( 'export' );
			wp_enqueue_style('chartstyle' );
			wp_enqueue_style('export' );
		}	
		
		*/
	}
	
	
	
	
	/**
	 *******************************************************************************
	 * Initiate shortcodes
	 * @since  0.1.0
	 * @return void
	 ********************************************************************************
	 */
	public function shortcodes() {
		add_shortcode( 'b2i_library_latest_item', array( $this, 'library_latest_item_shortcode' ) );
		add_shortcode( 'b2i_library_headline', array( $this, 'library_headline_shortcode' ) );
		add_shortcode( 'b2i_press_releases', array( $this, 'press_releases_shortcode' ) );
		add_shortcode( 'b2i_press_releases2', array( $this, 'press_releases_shortcode2' ) );
		add_shortcode( 'b2i_press_view', array( $this, 'press_view_shortcode' ) );
		add_shortcode( 'b2i_press_view2', array( $this, 'press_view_shortcode2' ) );
		add_shortcode( 'b2i_sec', array( $this, 'sec_shortcode' ) );
		add_shortcode( 'b2i_sec_view', array( $this, 'sec_view_shortcode' ) );
		add_shortcode( 'b2i_quote', array( $this, 'quote_shortcode' ) );
		add_shortcode( 'b2i_stock', array( $this, 'stock_shortcode' ) );
		add_shortcode( 'b2i_showcase', array( $this, 'showcase_shortcode' ) );
		add_shortcode( 'b2i_email_optin', array( $this, 'email_optin_shortcode' ) );
		add_shortcode( 'b2i_email_optin2', array( $this, 'email_optin_shortcode2' ) );
		//add_shortcode( 'b2i_email_optin3', array( $this, 'email_optin_shortcode3' ) );
		add_shortcode( 'b2i_email_unsubscribe', array( $this, 'email_unsubscribe_shortcode' ) );
		add_shortcode( 'b2i_request_optin', array( $this, 'request_optin_shortcode' ) );
		add_shortcode( 'b2i_request_optin2', array( $this, 'request_optin_shortcode2' ) );
		add_shortcode( 'b2i_myprofile', array( $this, 'myprofile_shortcode' ) );
		add_shortcode( 'b2i_myprofile2', array( $this, 'myprofile_shortcode2' ) );
		add_shortcode( 'b2i_contactus', array( $this, 'contactus_shortcode' ) );
		add_shortcode( 'b2i_contactus2', array( $this, 'contactus_shortcode2' ) );
		add_shortcode( 'b2i_committee', array( $this, 'comm_shortcode' ) );
		add_shortcode( 'b2i_directors', array( $this, 'directors_shortcode' ) );
		add_shortcode( 'b2i_director_view', array( $this, 'directors_view_shortcode' ) );
		add_shortcode( 'b2i_management', array( $this, 'management_shortcode' ) );
		add_shortcode( 'b2i_management_view', array( $this, 'management_view_shortcode' ) );
		add_shortcode( 'b2i_calendar', array( $this, 'cal_shortcode' ) );
		add_shortcode( 'b2i_cal_view', array( $this, 'cal_view_shortcode' ) );
		add_shortcode( 'b2i_cal_view2', array( $this, 'cal_view_shortcode2' ) );
		add_shortcode( 'b2i_institutional', array( $this, 'institutional_shortcode' ) );
		add_shortcode( 'b2i_insiders', array( $this, 'insiders_shortcode' ) );
		add_shortcode( 'b2i_financials', array( $this, 'financials_shortcode' ) );
		add_shortcode( 'b2i_HistoricalQuote', array( $this, 'HistoricalQuote_shortcode' ) );
		add_shortcode( 'b2i_analyst', array( $this, 'analyst_shortcode' ) );
		add_shortcode( 'b2i_code', array( $this, 'code_shortcode' ) );
		add_shortcode( 'b2i_page', array( $this, 'page_shortcode' ) );
		add_shortcode( 'b2i_corpprofile', array( $this, 'corpprofile_shortcode' ) );
		add_shortcode( 'b2i_dividends', array( $this, 'dividends_shortcode' ) );
		add_shortcode( 'b2i_calculator', array( $this, 'calculator_shortcode' ) );
		add_shortcode( 'b2i_chart', array( $this, 'chart_shortcode' ) );
		add_shortcode( 'b2i_intrachart', array( $this, 'intradaychart_shortcode' ) );
		add_shortcode( 'b2i_chart4', array( $this, 'chart_highchart_shortcode' ) );
		add_shortcode( 'b2i_chart5', array( $this, 'chart_amchart5_shortcode' ) );
		add_shortcode( 'b2i_chart_test', array( $this, 'Chart_shortcode_new' ) );
	}




	public function Chart_shortcode_new($atts)
	{
		$html = '';
		$dollarsign = '';
		$atts = shortcode_atts(
			array(
				'sdiv' => 'chartdiv',
				'h' => 'https',
				's' => '',
				'sd' => '',
				'e' => '',
				'ds' => '1',
				'lang' => '1',
				'c' => 'D42323',
				'lc' => '666666',
				'stl' => '1',
				'la' => '1', // label alpha
				'ls' => '15',
				'lc2' => '666666',
				'ls2' => '11',
				'lc3' => '333333',
				'ls3' => '20',
				'la3' => '0.2',
				'bgc' => 'ffffff',  // added 1
				'bga' => '1.0',
				'cbc' => '999999',  // added 2
				'cba' => '0.5',
				'bs' => '13',
				'bc' => '003399',
				'p' => '3m',
				'height' => '500px',
				'width' => '96%',
				'sp' => '1',
				'sc' => '1',
				'cc' => '003399',
				'cw' => '10',
				'ca' => '0.1',
				'ssb' => '1',
				'sbh' => '50',
				'sv' => '1',
				'lm' => '13',
				'rm' => '5',
				'tm' => '5',
				'bm' => '5',
				'vic' => '1',
				'ct' => 'Line',
				'vls' => 'left',
				'vct' => 'column',
				'vfa' => '.9',
				'fa' => '0.2',
				'stl' => '1',
				'sil' => '1',
				'lt' => '2',
				'ps' => 'bottom',
				'centsep' => '.',
				'thoussep' => ',',
				'volumetext' => 'Volume',
				'pricetext' => 'Price',
				'ga' => '.2',
				'gc' => 'D42323',
				'udg' => '0',
				'mode' => '0',
				'ulc' => '4CAF50',
				'ufc' => '4CAF50',
				'dlc' => 'ff0000',
				'dfc' => 'ff0000'
			),
			$atts
		);

		if ($atts['sd'] == '')
			$atts['sd'] = $atts['s'];

		switch ($atts['ds']) {
			case '0':
				$dollarsign = '';
				break;
			case '1':
				$dollarsign = '$';
				break;
			case '2':
				$dollarsign = '\u20AC';
				break;
			case '3':
				$dollarsign = '\u00A3';
				break;
			case '4':
				$dollarsign = '\u20AA';
				break;
			case '5':
				$dollarsign = '৳';
				break;
		}

		$html .= '<div id="' . esc_attr($atts['sdiv']) . '" class="B2iChartContainer" style="height: ' . esc_attr($atts['height']) . '; width:' . esc_attr($atts['width']) . ';"></div>' . "\n";
		$html .= '<div id="chartcontrols" class="B2iChartContainer" style="height: ' . esc_attr($atts['height']) . '; width:' . esc_attr($atts['width']) . ';"></div>' . "\n";
		//$html .= '<script src="' . esc_url(esc_attr( $atts['h'] ) . $this->base_url3 . 'profiles/inc/amstockgetJsData.asp?b=' ) . $this->business_id . '&s=' . esc_attr( $atts['s'] ) . '" type="text/javascript"></script>' . "\n";

		$html .= '<style>
				#' . esc_attr($atts['sdiv']) . '{
					background-color: #' . esc_attr($atts['bgc']) . ';
					opacity: ' . esc_attr($atts['bga']) . ';
				}
			</style>' . "\n";
		$html .= '<style src="https://www.b2i.us/profiles/inc/CSS.asp?m=5&b=' . $this->business_id . '&api=' . $this->key . '" type="text/javascript"></style>' . "\n";
		$html .= '<script src="https://www.b2i.us/profiles/inc/amstockgetJsData2.asp?b=' . $this->business_id . '&api=' . $this->key . '&s=' . esc_attr($atts['s']) . '&m=' . esc_attr($atts['mode']) . '" type="text/javascript"></script>' . "\n";
		//$html .= '<script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>' . "\n";
		$html .= '<script type="text/javascript">' . "\n";
		$html .= 'var chartData = [];' . "\n";
		$html .= 'loadData();' . "\n";
		$html .= 'chartData.map((e) => { e.date = moment(e.date).valueOf() } ); console.log(chartData)' . "\n";

		$html .= 'var root = am5.Root.new("' . esc_attr($atts['sdiv']) . '");

			root.interfaceColors.set("background", am5.color(0x5086BF));
		
			var stockChart = root.container.children.push(am5stock.StockChart.new(root, {
				stockPositiveColor: am5.color(0x00A2FF),
				stockNegativeColor: am5.color(0x00A2FF),
				volumePositiveColor: am5.color(0x00A2FF),
				volumeNegativeColor: am5.color(0x00A2FF)
			}));
			
			root.numberFormatter.set("numberFormat", "#,###.00"); ' . "\n";

		if ($atts['stl'] == 1) {
			$html .= 'stockChart.children.unshift(am5.Label.new(root, {
					text: "' . esc_attr($atts['e']) . '",
					fontSize: ' . esc_attr($atts['ls']) . ',
					fontWeight: "500",
					textAlign: "left",
					x: am5.percent(50),
					centerX: am5.percent(50),
					paddingTop: 0,
					paddingBottom: 0,
					fill: am5.color(0x' . esc_attr($atts['lc']) . '),
					opacity: ' . esc_attr($atts['la']) . ',
				}
			));' . "\n";
		}

		$html .=
			'var mainPanel = stockChart.panels.push(
				am5stock.StockPanel.new(root, {
					wheelY: "zoomX",
					panX: true,
					panY: false,
					height: am5.percent(70),
				})
			);' . "\n";

		// FOR DASHGRID
		if (esc_attr($atts['udg']) == 1) {
			$html .= 'var volumeAxisRendererY = am5xy.AxisRendererY.new(root, {});
			var valueAxis = mainPanel.yAxes.push(
				am5xy.ValueAxis.new(root, {
					renderer: volumeAxisRendererY,
					extraMin: 0.1, // adds some space for for main series
					tooltip: am5.Tooltip.new(root, {}),
					numberFormat: "#' . esc_attr($atts['thoussep']) . '###' . esc_attr($atts['centsep']) . '00",
					extraTooltipPrecision: 2,
				})
			);
			volumeAxisRendererY.grid.template.set("strokeDasharray", [10]);
			volumeAxisRendererY.grid.template.set("strokeOpacity", ' . esc_attr($atts['ga']) . ' );
			volumeAxisRendererY.grid.template.set("stroke", am5.color(0x' . esc_attr($atts['gc']) . '));
			volumeAxisRendererY.grid.template.set("pan", "zoom");

			var volumeAxisRendererX = am5xy.AxisRendererX.new(root, {});
			var dateAxis = mainPanel.xAxes.push(
				am5xy.GaplessDateAxis.new(root, {
					baseInterval: {
						timeUnit: "day",
						count: 1,
					},
					renderer: volumeAxisRendererX,
					tooltip: am5.Tooltip.new(root, {}),
				})
			);
			volumeAxisRendererX.grid.template.set("strokeDasharray", [10]);
			volumeAxisRendererX.grid.template.set("strokeOpacity", ' . esc_attr($atts['ga']) . ' );
			volumeAxisRendererX.grid.template.set("stroke", am5.color(0x' . esc_attr($atts['gc']) . '));
			' . "\n";
		} else {
			$html .= 'var valueAxis = mainPanel.yAxes.push(
				am5xy.ValueAxis.new(root, {
					renderer: am5xy.AxisRendererY.new(root, {
						pan: "zoom",
					}),
					extraMin: 0.1, // adds some space for for main series
					tooltip: am5.Tooltip.new(root, {}),
					numberFormat: "#' . esc_attr($atts['thoussep']) . '###' . esc_attr($atts['centsep']) . '00",
					extraTooltipPrecision: 2,
				})
			);

			var dateAxis = mainPanel.xAxes.push(
				am5xy.GaplessDateAxis.new(root, {
					baseInterval: {
						timeUnit: "day",
						count: 1,
					},
					renderer: am5xy.AxisRendererX.new(root, {
						fill: am5.color(0xFF0000),
						stroke: am5.color(0xFF0000),
						strokeDasharray: [10]
					}),
					tooltip: am5.Tooltip.new(root, {}),
				})
			);
			' . "\n";
		}

		// END FOR DASHGRID

		$html .= 'var valueSeries = mainPanel.series.push(am5xy.' . ucwords(esc_attr($atts['ct'])) . '.new(root, {
					name: "' . $atts['sd'] . '",
					clustered: true,
					valueXField: "date",
					valueYField: "value",
					highValueYField: "high",
					lowValueYField: "low",
					openValueYField: "open",
					calculateAggregates: true,
					xAxis: dateAxis,
					yAxis: valueAxis,
					legendValueText: "open: [bold]{openValueY}[/] high: [bold]{highValueY}[/] low: [bold]{lowValueY}[/] close: [bold]{valueY}[/]",
					fillColors: "#FF0000",
  					strokeWidth: 200,
					minDistance: 1,
					tooltip: am5.Tooltip.new(root, {
						pointerOrientation: "horizontal",
						labelText: "{valueY}"
					})
				})
			);' . "\n";

		$html .= 'valueSeries.set("fill", am5.color(0xff0000));' . "\n";

		if (esc_attr($atts['ct']) != "ColumnSeries" || esc_attr($atts['ct']) != "CandlestickSeries") {
			$html .= '
				valueSeries.strokes.template.setAll({
					strokeWidth: ' . esc_attr($atts['lt']) . ',
    				color: am5.color(0x' . esc_attr($atts['c']) . '),
					strokeDasharray: []
				});' . "\n";
			$html .= '
				valueSeries.fills.template.setAll({
    				color: am5.color(0x' . esc_attr($atts['c']) . '),
				});' . "\n";
		}

		$html .=
			'stockChart.set("stockSeries", valueSeries);
			
			var valueLegend = mainPanel.plotContainer.children.push(
				am5stock.StockLegend.new(root, {
					stockChart: stockChart,
				})
			);
			
			var volumePanel = stockChart.panels.push(
				am5stock.StockPanel.new(root, {
					panX: true,
					panY: true,
					height: am5.percent(30),
					paddingTop: 6,
				})
			);
			
			volumePanel.panelControls.closeButton.set("forceHidden", true);

			var volumeDateAxis = volumePanel.xAxes.push(
				am5xy.GaplessDateAxis.new(root, {
					baseInterval: {
						timeUnit: "day",
						count: 1,
					},
					renderer: am5xy.AxisRendererX.new(root, {}),
					tooltip: am5.Tooltip.new(root, {
						forceHidden: true,
					}),
					height: 0,
				})
			);
			
			volumeDateAxis.get("renderer").labels.template.set("forceHidden", true);
			
			var volumeAxisRenderer = am5xy.AxisRendererY.new(root, {});

			var volumeValueAxis = volumePanel.yAxes.push(
				am5xy.ValueAxis.new(root, {
					numberFormat: "#' . esc_attr($atts['centsep']) . '#a",
					renderer: volumeAxisRenderer,
				})
			);
			
			var volumeSeries = volumePanel.series.push(am5xy.' . ucwords(esc_attr($atts['vct'])) . '.new(root, {
					name: "Volume",
					clustered: false,
					valueXField: "date",
					valueYField: "volume",
					xAxis: volumeDateAxis,
					yAxis: volumeValueAxis,
					legendValueText: "[bold]{valueY.formatNumber(\'#,###.0a\')}[/]",
				})
			);

			// TODO:: পরে
			// volumeSeries.columns.template.setAll({
			// 	strokeOpacity: 0,
			// 	fillOpacity: 0.5,
			// });
			
			// volumeSeries.columns.template.adapters.add("fill", function (fill, target) {
			// 	var dataItem = target.dataItem;
			// 	if (dataItem) {
			// 		return stockChart.getVolumeColor(dataItem);
			// 	}
			// 	return fill;
			// });
			
			var volumeLegend = volumePanel.plotContainer.children.push(
				am5stock.StockLegend.new(root, {
					stockChart: stockChart,
				})
			);
			
			stockChart.set("volumeSeries", volumeSeries);
			valueLegend.data.setAll([valueSeries]);
			volumeLegend.data.setAll([volumeSeries]);' . "\n";

		// ADD CURSOR TO MAIN PANEL
		// START OF MAIN PANEL CURSOR SETTINGS
		if (esc_attr($atts['sc']) == 1) {
			$html .= 'var cursor = mainPanel.set("cursor", am5xy.XYCursor.new(root, {
							yAxis: valueAxis,
							xAxis: dateAxis,
							snapToSeries: [valueSeries],
							snapToSeriesBy: "y!",
						}
					));

					cursor.lineX.setAll({
						stroke: am5.color(0x' . esc_attr($atts['cc']) . '),
						strokeWidth: ' . esc_attr($atts['cw']) . ',
						strokeDasharray: [],
						strokeOpacity: ' . esc_attr($atts['ca']) . ',
					});

					cursor.lineY.setAll({
						stroke: am5.color(0x' . esc_attr($atts['cc']) . '),
						strokeWidth: ' . esc_attr($atts['cw']) . ',
						strokeDasharray: [],
						strokeOpacity: ' . esc_attr($atts['ca']) . ',
					});

					' . "\n";
		}
		// END OF MAIN PANEL CURSOR SETTINGS

		// ADD CURSOR TO VOLUME
		// START OF VOLUME PANEL CURSOR SETTINGS
		if (esc_attr($atts['sv']) == 1) {
			$html .= 'var volumeCursor = volumePanel.set("cursor", am5xy.XYCursor.new(root, {
							yAxis: volumeValueAxis,
							xAxis: volumeDateAxis,
							snapToSeries: [volumeSeries],
							snapToSeriesBy: "y!",
							opacity: 1,
						})
					);

					volumeCursor.lineY.set("forceHidden", true);

					volumeCursor.lineX.setAll({
						stroke: am5.color(0x' . esc_attr($atts['cc']) . '),
						strokeWidth: ' . esc_attr($atts['cw']) . ',
						strokeDasharray: [],
						strokeOpacity: ' . esc_attr($atts['ca']) . ',
					});

					volumeCursor.lineY.setAll({
						stroke: am5.color(0x' . esc_attr($atts['cc']) . '),
						strokeWidth: ' . esc_attr($atts['cw']) . ',
						strokeDasharray: [],
						strokeOpacity: ' . esc_attr($atts['ca']) . ',
					});

					' . "\n";
		}
		// END OF VOLUME PANEL CURSOR SETTINGS

		// START OF SCROLLBAR
		if (esc_attr($atts['ssb']) == 1) {
			$html .=
				'var scrollbar = mainPanel.set("scrollbarX", am5xy.XYChartScrollbar.new(root, {
					orientation: "horizontal",
					height: ' . esc_attr($atts['sbh']) . ',
				})
			);
			stockChart.toolsContainer.children.push(scrollbar);    

			var sbDateAxis = scrollbar.chart.xAxes.push(am5xy.GaplessDateAxis.new(root, {
					baseInterval: {
						timeUnit: "day",
						count: 1,
					},
					renderer: am5xy.AxisRendererX.new(root, {}),
				})
			);

			var sbValueAxis = scrollbar.chart.yAxes.push(am5xy.ValueAxis.new(root, {
					renderer: am5xy.AxisRendererY.new(root, {}),
				})
			);

			var sbSeries = scrollbar.chart.series.push(am5xy.LineSeries.new(root, {
					valueYField: "value",
					valueXField: "date",
					xAxis: sbDateAxis,
					yAxis: sbValueAxis,
				})
			);

			sbSeries.fills.template.setAll({
				visible: true,
				fill: am5.color(0xFF000),
				stroke: am5.color(0xFF000),
				fillOpacity: 1
			});' . "\n";
		}
		// END OF SCROLLBAR

		$html .=
			'var seriesSwitcher = am5stock.SeriesTypeControl.new(root, {
				stockChart: stockChart,
			});

			seriesSwitcher.events.on("selected", function (ev) {
				setSeriesType(ev.item.id);
			});

			function getNewSettings(series) {
				var newSettings = [];
				am5.array.each(
					["name", "valueYField", "highValueYField", "lowValueYField", "openValueYField", "calculateAggregates", "valueXField", "xAxis", "yAxis", "legendValueText", "stroke", "fill"],
					function (setting) {
						newSettings[setting] = series.get(setting);
					}
				);
				return newSettings;
			}

			function setSeriesType(seriesType) {        
				var currentSeries = stockChart.get("stockSeries");
				var newSettings = getNewSettings(currentSeries);
				
				var data = currentSeries.data.values;
				mainPanel.series.removeValue(currentSeries);
				
				var series;
				switch (seriesType) {
					case "line":
						series = mainPanel.series.push(am5xy.LineSeries.new(root, newSettings));
						break;
					case "candlestick":
					case "procandlestick":
						newSettings.clustered = false;
						series = mainPanel.series.push(am5xy.CandlestickSeries.new(root, newSettings));
						if (seriesType == "procandlestick") {
							series.columns.template.get("themeTags").push("pro");
						}
						break;
					case "ohlc":
						newSettings.clustered = false;
						series = mainPanel.series.push(am5xy.OHLCSeries.new(root, newSettings));
						break;
				}
				
				if (series) {
					valueLegend.data.removeValue(currentSeries);
					series.data.setAll(data);
					stockChart.set("stockSeries", series);
					var cursor = mainPanel.get("cursor");
					if (cursor) {
						cursor.set("snapToSeries", [series]);
					}
					valueLegend.data.insertIndex(0, series);
				}
			}
			
			var toolbar = am5stock.StockToolbar.new(root, {
				container: document.getElementById("chartcontrols"),
				stockChart: stockChart,
				controls: [' . "\n";
		if (esc_attr($atts['sp']) == 1) {
			$html .= 'am5stock.IndicatorControl.new(root, {
		      stockChart: stockChart,
		      legend: valueLegend
		    }),
		    am5stock.DateRangeSelector.new(root, {
		      stockChart: stockChart
		    }),
			am5stock.PeriodSelector.new(root, {
								stockChart: stockChart,
								periods: [{
									timeUnit: "day",
									count: 10,
									name: "10D",
									active: true,
									visible: false
								},
								{
									timeUnit: "month",
									count: 1,
									name: "1M"
								},
								{
									timeUnit: "month",
									count: 3,
									name: "3M"
								},
								{
									timeUnit: "month",
									count: 6,
									name: "6M"
								},
								{
									timeUnit: "year",
									count: 1,
									name: "1Y"
								},
								{
									timeUnit: "year",
									count: 5,
									name: "5Y"
								},
								{
									timeUnit: "max",
									name: "ALL"
								}]
							}), ' . "\n";
		}
		$html .= 'am5stock.SettingsControl.new(root, {
						stockChart: stockChart,
					}),
				],
			});

			var data = chartData;

			valueSeries.data.setAll(data);
			volumeSeries.data.setAll(data);

			' . "\n";

		if (esc_attr($atts['ssb']) == 1) {
			$html .= 'sbSeries.data.setAll(data);' . "\n";
		}


		$html .= '</script>' . "\n";

		// print_r($html);
		// exit();
		return $html;
	}



	/**
	*********************************************************************************
	 * Define the High Chart shortcode 
	 * @since  1.7
	 * @return string
	*********************************************************************************
	 */
	public function chart_highchart_shortcode( $atts ) {
		$html = '';
		$dollarsign='';
		$atts = shortcode_atts(
			array(
				'sdiv' => 'highchartdiv',
				'h' => 'https',
				's' => '',
				'sd' => '',
				'e' => '',
				'ds' => '1',
				'lang' => '1',
				'c' => '003399',
				'lc' => '666666',
				'ls' => '15',
				'lc2' => '666666',
				'ls2' => '11',
				'lc3' => '333333',
				'ls3' => '20',
				'la3' => '0.2',
				'cc' => '003399',
				'bgc' => 'ffffff',
				'bga' => '1.0',
				'cbc' => '999999',
				'cba' => '0.5',
				'bs' => '13',
				'bc' => '003399',
				'p' => '3m',
				'height' => '500px',
				'width' => '96%',
				'sp' => '1',
				'sc' => '1',
				'ssb' => '1',
				'sv' => '1',
				'lm' => '13',
				'rm' => '5',
				'tm' => '5',
				'bm' => '5',
				'vic' => '1',
				'ct' => 'line',
				'vls' => 'left',
				'vct' => 'column',
				'vfa' => '.9',
				'fa' => '0.2',
				'ca' => '0.1',
				'stl' => '1',
				'sil' => '1',
				'lt' => '2',
				'ps' => 'bottom',
				'centsep' => '.',
				'thoussep' => ',',
				'volumetext' => 'Volume',
				'pricetext' => 'Price',
				'ga' => '.2',
				'gc' => 'bbbbbb',
				'udg' => '0',
				'mode' => '0',
				'ulc' => '4CAF50',
				'ufc' => '4CAF50',
				'dlc' => 'ff0000',
				'dfc' => 'ff0000'
			),
			$atts
		);
if($atts['sd']=='')$atts['sd'] = $ticker ;
switch ($atts['ds']) {
  case '0':
	$dollarsign='';
	break;
  case '1':
	$dollarsign='$';
	break;
  case '2':
	$dollarsign='\u20AC';
	break;
  case '3':
	$dollarsign='\u00A3';
	break;
  case '4':
	$dollarsign='\u20AA';
	break;
  case '5':
    $dollarsign='৳';
    break;
}

$html .= '<div id="' . esc_attr( $atts['sdiv'] ) . '" class="B2iChartContainer" style="height: ' . esc_attr( $atts['height'] ) . '; width:' . esc_attr( $atts['width'] ) . ';"></div>' . "\n";

$html .= '<script src="https://stockcharting.s3.amazonaws.com/highstock.js" type="text/javascript"></script>' . "\n";
$html .= '<script src="https://stockcharting.s3.amazonaws.com/data.js" type="text/javascript"></script>' . "\n";
$html .= '<script type="text/javascript">' . "\n";
$html .= 'Highcharts.getJSON("https://demo-live-data.highcharts.com/aapl-ohlcv.json", function (data) {' . "\n";
$html .= '    // split the data set into ohlc and volume
    var ohlc = [],
        volume = [],
        dataLength = data.length,
        i = 0;

    for (i; i < dataLength; i += 1) {
        ohlc.push([
            data[i][0], // the date
            data[i][1], // open
            data[i][2], // high
            data[i][3], // low
            data[i][4] // close
        ]);

        volume.push([
            data[i][0], // the date
            data[i][5] // the volume
        ]); } ' . "\n";

$html .= 'Highcharts.stockChart("' . esc_attr( $atts['sdiv'] ) . '", { ' . "\n";
$html .= "yAxis: [{
            height: '80%',
            resize: {
                enabled: true
            }
        }, {
            top: '80%',
            height: '20%',
            offset: 0
        }],
        tooltip: {
            shape: 'square',
            headerShape: 'callout',
            borderWidth: 0,
            shadow: false,
            positioner: function (width, height, point) {
                var chart = this.chart,
                    position;

                if (point.isHeader) {
                    position = {
                        x: Math.max(
                            // Left side limit
                            chart.plotLeft,
                            Math.min(
                                point.plotX + chart.plotLeft - width / 2,
                                // Right side limit
                                chart.chartWidth - width - chart.marginRight
                            )
                        ),
                        y: point.plotY
                    };
                } else {
                    position = {
                        x: point.series.chart.plotLeft,
                        y: point.series.yAxis.top - chart.plotTop
                    };
                }

                return position;
            }
        },
        series: [{
            type: 'ohlc',
            id: 'aapl-ohlc',
            name: '" . $atts['sd']  . " " . $dollarsign  . "',
            data: ohlc
        }, {
            type: 'column',
            id: 'aapl-volume',
            name: '" . $atts['sd']  . " Volume',
            data: volume,
            yAxis: 1
        }],
        responsive: {
            rules: [{
                condition: {
                    maxWidth: 800
                },
                chartOptions: {
                    rangeSelector: {
                        buttons: [{
                            type: 'day',
                            count: 10,
                            text: '10d'
                        }, {
                            type: 'month',
                            count: 1,
                            text: '1m'
                        }, {
                            type: 'month',
                            count: 3,
                            text: '3m'
                        }, {
                            type: 'month',
                            count: 6,
                            text: '6m'
                        }, {
                            type: 'year',
                            count: 1,
                            text: '1y'
                        }, {
                            type: 'year',
                            count: 5,
                            text: '5y'
                        }, {
                            type: 'all',
                            text: 'All'
                        }],
                        selected: 2,
                        inputEnabled: false
                    }
                }
            }]
        }
    });" . "\n";
$html .= '}); ' . "\n";


$html .= '</script>' . "\n";

return $html;
}

	

	/**
	*********************************************************************************
	 * Define the Chart  plugin shortcode (Chart Version: 3)
	 * @since  1.7.
	 * @return string
	*********************************************************************************
	 */
	public function chart_amchart5_shortcode( $atts ) {
		$html = '';
		$dollarsign = '';
		$atts = shortcode_atts(
			array(
				'sdiv' => 'chartdiv',
				'h' => 'https',
				's' => '',
				'sd' => '',
				'e' => '',
				'ds' => '1',
				'lang' => '1',
				'c' => 'D42323',
				'lc' => '666666',
				'stl' => '1',
				'la' => '1', // label alpha
				'ls' => '15',
				'lc2' => '666666',
				'ls2' => '11',
				'lc3' => '333333',
				'ls3' => '20',
				'la3' => '0.2',
				'bgc' => 'ffffff',  // added 1
				'bga' => '1.0',
				'cbc' => '999999',  // added 2
				'cba' => '0.5',
				'bs' => '13',
				'bc' => '003399',
				'p' => '3m',
				'height' => '500px',
				'width' => '96%',
				'sp' => '1',
				'sc' => '1',
				'cc' => '003399',
				'cw' => '10',
				'ca' => '0.1',
				'ssb' => '1',
				'sbh' => '50',
				'sv' => '1',
				'lm' => '13',
				'rm' => '5',
				'tm' => '5',
				'bm' => '5',
				'vic' => '1',
				'ct' => 'LineSeries',
				'vls' => 'left',
				'vct' => 'ColumnSeries',
				'vfa' => '.9',
				'fa' => '0.2',
				'sil' => '1',
				'lt' => '2',
				'ps' => 'bottom',
				'centsep' => '.',
				'thoussep' => ',',
				'volumetext' => 'Volume',
				'pricetext' => 'Price',
				'ga' => '.2',
				'gc' => 'D42323',
				'udg' => '0',
				'mode' => '0',
				'ulc' => '4CAF50',
				'ufc' => '4CAF50',
				'dlc' => 'ff0000',
				'dfc' => 'ff0000'
			),
			$atts
		);

		if ($atts['sd'] == '')
			$atts['sd'] = $ticker;

		switch ($atts['ds']) {
			case '0':
				$dollarsign = '';
				break;
			case '1':
				$dollarsign = '$';
				break;
			case '2':
				$dollarsign = '\u20AC';
				break;
			case '3':
				$dollarsign = '\u00A3';
				break;
			case '4':
				$dollarsign = '\u20AA';
				break;
			case '5':
				$dollarsign = '৳';
				break;
		}

		$html .= '<div id="' . esc_attr($atts['sdiv']) . '" class="B2iChartContainer" style="height: ' . esc_attr($atts['height']) . '; width:' . esc_attr($atts['width']) . ';"></div>' . "\n";
		$html .= '<div id="chartcontrols" class="B2iChartContainer" style="height: ' . esc_attr($atts['height']) . '; width:' . esc_attr($atts['width']) . ';"></div>' . "\n";
		//$html .= '<script src="' . esc_url(esc_attr( $atts['h'] ) . $this->base_url3 . 'profiles/inc/amstockgetJsData.asp?b=' ) . $this->business_id . '&s=' . esc_attr( $atts['s'] ) . '" type="text/javascript"></script>' . "\n";

		$html .= '<style>
				#' . esc_attr($atts['sdiv']) . '{
					background-color: #' . esc_attr($atts['bgc']) . ';
					opacity: ' . esc_attr($atts['bga']) . ';
				}
			</style>' . "\n";
		$html .= '<script src="https://stockcharting.s3.amazonaws.com/index.js" type="text/javascript"></script>' . "\n";
		$html .= '<script src="https://stockcharting.s3.amazonaws.com/xy.js" type="text/javascript"></script>' . "\n";
		$html .= '<script src="https://stockcharting.s3.amazonaws.com/stock.js" type="text/javascript"></script>' . "\n";
		$html .= '<script src="https://stockcharting.s3.amazonaws.com/exporting.js" type="text/javascript"></script>' . "\n";
		$html .= '<script src="https://stockcharting.s3.amazonaws.com/moment.min.js" type="text/javascript"></script>' . "\n";
		
		$html .= '<style src="https://www.b2i.us/profiles/inc/CSS.asp?m=5&b=' . $this->business_id . '&api=' . $this->key . '" type="text/javascript"></style>' . "\n";
		$html .= '<script src="https://www.b2i.us/profiles/inc/amstockgetJsData2.asp?b=' . $this->business_id . '&api=' . $this->key . '&s=' . esc_attr($atts['s']) . '&m=' . esc_attr($atts['mode']) . '" type="text/javascript"></script>' . "\n";
				
		$html .= '<script type="text/javascript">' . "\n";
		$html .= 'var chartData = [];' . "\n";
		$html .= 'loadData();' . "\n";
		$html .= 'chartData.map((e) => { e.date = moment(e.date).valueOf() } ); console.log(chartData)' . "\n";

		$html .= 'var root = am5.Root.new("' . esc_attr($atts['sdiv']) . '");

			root.interfaceColors.set("background", am5.color(0x5086BF));
		
			var stockChart = root.container.children.push(am5stock.StockChart.new(root, {
				stockPositiveColor: am5.color(0x00A2FF),
				stockNegativeColor: am5.color(0x00A2FF),
				volumePositiveColor: am5.color(0x00A2FF),
				volumeNegativeColor: am5.color(0x00A2FF)
			}));
			
			root.numberFormatter.set("numberFormat", "#,###.00"); ' . "\n";

		if ($atts['stl'] == 1) {
			$html .= 'stockChart.children.unshift(am5.Label.new(root, {
					text: "' . esc_attr($atts['e']) . '",
					fontSize: ' . esc_attr($atts['ls']) . ',
					fontWeight: "500",
					textAlign: "left",
					x: am5.percent(50),
					centerX: am5.percent(50),
					paddingTop: 0,
					paddingBottom: 0,
					fill: am5.color(0x' . esc_attr($atts['lc']) . '),
					opacity: ' . esc_attr($atts['la']) . ',
				}
			));' . "\n";
		}

		$html .=
			'var mainPanel = stockChart.panels.push(
				am5stock.StockPanel.new(root, {
					wheelY: "zoomX",
					panX: true,
					panY: false,
					height: am5.percent(70),
				})
			);' . "\n";

		// FOR DASHGRID
		if (esc_attr($atts['udg']) == 1) {
			$html .= 'var volumeAxisRendererY = am5xy.AxisRendererY.new(root, {});
			var valueAxis = mainPanel.yAxes.push(
				am5xy.ValueAxis.new(root, {
					renderer: volumeAxisRendererY,
					extraMin: 0.1, // adds some space for for main series
					tooltip: am5.Tooltip.new(root, {}),
					numberFormat: "#' . esc_attr($atts['thoussep']) . '###' . esc_attr($atts['centsep']) . '00",
					extraTooltipPrecision: 2,
				})
			);
			volumeAxisRendererY.grid.template.set("strokeDasharray", [10]);
			volumeAxisRendererY.grid.template.set("strokeOpacity", ' . esc_attr($atts['ga']) . ' );
			volumeAxisRendererY.grid.template.set("stroke", am5.color(0x' . esc_attr($atts['gc']) . '));
			volumeAxisRendererY.grid.template.set("pan", "zoom");

			var volumeAxisRendererX = am5xy.AxisRendererX.new(root, {});
			var dateAxis = mainPanel.xAxes.push(
				am5xy.GaplessDateAxis.new(root, {
					baseInterval: {
						timeUnit: "day",
						count: 1,
					},
					renderer: volumeAxisRendererX,
					tooltip: am5.Tooltip.new(root, {}),
				})
			);
			volumeAxisRendererX.grid.template.set("strokeDasharray", [10]);
			volumeAxisRendererX.grid.template.set("strokeOpacity", ' . esc_attr($atts['ga']) . ' );
			volumeAxisRendererX.grid.template.set("stroke", am5.color(0x' . esc_attr($atts['gc']) . '));
			' . "\n";
		} else {
			$html .= 'var valueAxis = mainPanel.yAxes.push(
				am5xy.ValueAxis.new(root, {
					renderer: am5xy.AxisRendererY.new(root, {
						pan: "zoom",
					}),
					extraMin: 0.1, // adds some space for for main series
					tooltip: am5.Tooltip.new(root, {}),
					numberFormat: "#' . esc_attr($atts['thoussep']) . '###' . esc_attr($atts['centsep']) . '00",
					extraTooltipPrecision: 2,
				})
			);

			var dateAxis = mainPanel.xAxes.push(
				am5xy.GaplessDateAxis.new(root, {
					baseInterval: {
						timeUnit: "day",
						count: 1,
					},
					renderer: am5xy.AxisRendererX.new(root, {
						fill: am5.color(0xFF0000),
						stroke: am5.color(0xFF0000),
						strokeDasharray: [10]
					}),
					tooltip: am5.Tooltip.new(root, {}),
				})
			);
			' . "\n";
		}

		// END FOR DASHGRID

		$html .= 'var valueSeries = mainPanel.series.push(am5xy.' . ucwords(esc_attr($atts['ct'])) . '.new(root, {
					name: "' . $atts['sd'] . '",
					clustered: true,
					valueXField: "date",
					valueYField: "value",
					highValueYField: "high",
					lowValueYField: "low",
					openValueYField: "open",
					calculateAggregates: true,
					xAxis: dateAxis,
					yAxis: valueAxis,
					legendValueText: "open: [bold]{openValueY}[/] high: [bold]{highValueY}[/] low: [bold]{lowValueY}[/] close: [bold]{valueY}[/]",
					fillColors: "#FF0000",
  					strokeWidth: 200,
					minDistance: 1,
					tooltip: am5.Tooltip.new(root, {
						pointerOrientation: "horizontal",
						labelText: "{valueY}"
					})
				})
			);' . "\n";

		$html .= 'valueSeries.set("fill", am5.color(0xff0000));' . "\n";

		if (esc_attr($atts['ct']) != "ColumnSeries" || esc_attr($atts['ct']) != "CandlestickSeries") {
			$html .= '
				valueSeries.strokes.template.setAll({
					strokeWidth: ' . esc_attr($atts['lt']) . ',
    				color: am5.color(0x' . esc_attr($atts['c']) . '),
					strokeDasharray: []
				});' . "\n";
			$html .= '
				valueSeries.fills.template.setAll({
    				color: am5.color(0x' . esc_attr($atts['c']) . '),
				});' . "\n";
		}

		$html .=
			'stockChart.set("stockSeries", valueSeries);
			
			var valueLegend = mainPanel.plotContainer.children.push(
				am5stock.StockLegend.new(root, {
					stockChart: stockChart,
				})
			);
			
			var volumePanel = stockChart.panels.push(
				am5stock.StockPanel.new(root, {
					panX: true,
					panY: true,
					height: am5.percent(30),
					paddingTop: 6,
				})
			);
			
			volumePanel.panelControls.closeButton.set("forceHidden", true);

			var volumeDateAxis = volumePanel.xAxes.push(
				am5xy.GaplessDateAxis.new(root, {
					baseInterval: {
						timeUnit: "day",
						count: 1,
					},
					renderer: am5xy.AxisRendererX.new(root, {}),
					tooltip: am5.Tooltip.new(root, {
						forceHidden: true,
					}),
					height: 0,
				})
			);
			
			volumeDateAxis.get("renderer").labels.template.set("forceHidden", true);
			
			var volumeAxisRenderer = am5xy.AxisRendererY.new(root, {});

			var volumeValueAxis = volumePanel.yAxes.push(
				am5xy.ValueAxis.new(root, {
					numberFormat: "#' . esc_attr($atts['centsep']) . '#a",
					renderer: volumeAxisRenderer,
				})
			);
			
			var volumeSeries = volumePanel.series.push(am5xy.' . ucwords(esc_attr($atts['vct'])) . '.new(root, {
					name: "Volume",
					clustered: false,
					valueXField: "date",
					valueYField: "volume",
					xAxis: volumeDateAxis,
					yAxis: volumeValueAxis,
					legendValueText: "[bold]{valueY.formatNumber(\'#,###.0a\')}[/]",
				})
			);

			// TODO:: পরে
			// volumeSeries.columns.template.setAll({
			// 	strokeOpacity: 0,
			// 	fillOpacity: 0.5,
			// });
			
			// volumeSeries.columns.template.adapters.add("fill", function (fill, target) {
			// 	var dataItem = target.dataItem;
			// 	if (dataItem) {
			// 		return stockChart.getVolumeColor(dataItem);
			// 	}
			// 	return fill;
			// });
			
			var volumeLegend = volumePanel.plotContainer.children.push(
				am5stock.StockLegend.new(root, {
					stockChart: stockChart,
				})
			);
			
			stockChart.set("volumeSeries", volumeSeries);
			valueLegend.data.setAll([valueSeries]);
			volumeLegend.data.setAll([volumeSeries]);' . "\n";

		// ADD CURSOR TO MAIN PANEL
		// START OF MAIN PANEL CURSOR SETTINGS
		if (esc_attr($atts['sc']) == 1) {
			$html .= 'var cursor = mainPanel.set("cursor", am5xy.XYCursor.new(root, {
							yAxis: valueAxis,
							xAxis: dateAxis,
							snapToSeries: [valueSeries],
							snapToSeriesBy: "y!",
						}
					));

					cursor.lineX.setAll({
						stroke: am5.color(0x' . esc_attr($atts['cc']) . '),
						strokeWidth: ' . esc_attr($atts['cw']) . ',
						strokeDasharray: [],
						strokeOpacity: ' . esc_attr($atts['ca']) . ',
					});

					cursor.lineY.setAll({
						stroke: am5.color(0x' . esc_attr($atts['cc']) . '),
						strokeWidth: ' . esc_attr($atts['cw']) . ',
						strokeDasharray: [],
						strokeOpacity: ' . esc_attr($atts['ca']) . ',
					});

					' . "\n";
		}
		// END OF MAIN PANEL CURSOR SETTINGS

		// ADD CURSOR TO VOLUME
		// START OF VOLUME PANEL CURSOR SETTINGS
		if (esc_attr($atts['sv']) == 1) {
			$html .= 'var volumeCursor = volumePanel.set("cursor", am5xy.XYCursor.new(root, {
							yAxis: volumeValueAxis,
							xAxis: volumeDateAxis,
							snapToSeries: [volumeSeries],
							snapToSeriesBy: "y!",
							opacity: 1,
						})
					);

					volumeCursor.lineY.set("forceHidden", true);

					volumeCursor.lineX.setAll({
						stroke: am5.color(0x' . esc_attr($atts['cc']) . '),
						strokeWidth: ' . esc_attr($atts['cw']) . ',
						strokeDasharray: [],
						strokeOpacity: ' . esc_attr($atts['ca']) . ',
					});

					volumeCursor.lineY.setAll({
						stroke: am5.color(0x' . esc_attr($atts['cc']) . '),
						strokeWidth: ' . esc_attr($atts['cw']) . ',
						strokeDasharray: [],
						strokeOpacity: ' . esc_attr($atts['ca']) . ',
					});

					' . "\n";
		}
		// END OF VOLUME PANEL CURSOR SETTINGS

		// START OF SCROLLBAR
		if (esc_attr($atts['ssb']) == 1) {
			$html .=
				'var scrollbar = mainPanel.set("scrollbarX", am5xy.XYChartScrollbar.new(root, {
					orientation: "horizontal",
					height: ' . esc_attr($atts['sbh']) . ',
				})
			);
			stockChart.toolsContainer.children.push(scrollbar);    

			var sbDateAxis = scrollbar.chart.xAxes.push(am5xy.GaplessDateAxis.new(root, {
					baseInterval: {
						timeUnit: "day",
						count: 1,
					},
					renderer: am5xy.AxisRendererX.new(root, {}),
				})
			);

			var sbValueAxis = scrollbar.chart.yAxes.push(am5xy.ValueAxis.new(root, {
					renderer: am5xy.AxisRendererY.new(root, {}),
				})
			);

			var sbSeries = scrollbar.chart.series.push(am5xy.LineSeries.new(root, {
					valueYField: "value",
					valueXField: "date",
					xAxis: sbDateAxis,
					yAxis: sbValueAxis,
				})
			);

			sbSeries.fills.template.setAll({
				visible: true,
				fill: am5.color(0xFF000),
				stroke: am5.color(0xFF000),
				fillOpacity: 1
			});' . "\n";
		}
		// END OF SCROLLBAR

		$html .=
			'var seriesSwitcher = am5stock.SeriesTypeControl.new(root, {
				stockChart: stockChart,
			});

			seriesSwitcher.events.on("selected", function (ev) {
				setSeriesType(ev.item.id);
			});

			function getNewSettings(series) {
				var newSettings = [];
				am5.array.each(
					["name", "valueYField", "highValueYField", "lowValueYField", "openValueYField", "calculateAggregates", "valueXField", "xAxis", "yAxis", "legendValueText", "stroke", "fill"],
					function (setting) {
						newSettings[setting] = series.get(setting);
					}
				);
				return newSettings;
			}

			function setSeriesType(seriesType) {        
				var currentSeries = stockChart.get("stockSeries");
				var newSettings = getNewSettings(currentSeries);
				
				var data = currentSeries.data.values;
				mainPanel.series.removeValue(currentSeries);
				
				var series;
				switch (seriesType) {
					case "line":
						series = mainPanel.series.push(am5xy.LineSeries.new(root, newSettings));
						break;
					case "candlestick":
					case "procandlestick":
						newSettings.clustered = false;
						series = mainPanel.series.push(am5xy.CandlestickSeries.new(root, newSettings));
						if (seriesType == "procandlestick") {
							series.columns.template.get("themeTags").push("pro");
						}
						break;
					case "ohlc":
						newSettings.clustered = false;
						series = mainPanel.series.push(am5xy.OHLCSeries.new(root, newSettings));
						break;
				}
				
				if (series) {
					valueLegend.data.removeValue(currentSeries);
					series.data.setAll(data);
					stockChart.set("stockSeries", series);
					var cursor = mainPanel.get("cursor");
					if (cursor) {
						cursor.set("snapToSeries", [series]);
					}
					valueLegend.data.insertIndex(0, series);
				}
			}
			
			var toolbar = am5stock.StockToolbar.new(root, {
				container: document.getElementById("chartcontrols"),
				stockChart: stockChart,
				controls: [' . "\n";
		if (esc_attr($atts['sp']) == 1) {
			$html .= 'am5stock.IndicatorControl.new(root, {
		      stockChart: stockChart,
		      legend: valueLegend
		    }),
		    am5stock.DateRangeSelector.new(root, {
		      stockChart: stockChart
		    }),
			am5stock.PeriodSelector.new(root, {
								stockChart: stockChart,
								periods: [{
									timeUnit: "day",
									count: 10,
									name: "10D",
									active: true,
									visible: false
								},
								{
									timeUnit: "month",
									count: 1,
									name: "1M"
								},
								{
									timeUnit: "month",
									count: 3,
									name: "3M"
								},
								{
									timeUnit: "month",
									count: 6,
									name: "6M"
								},
								{
									timeUnit: "year",
									count: 1,
									name: "1Y"
								},
								{
									timeUnit: "year",
									count: 5,
									name: "5Y"
								},
								{
									timeUnit: "max",
									name: "ALL"
								}]
							}), ' . "\n";
		}
		$html .= 'am5stock.SettingsControl.new(root, {
						stockChart: stockChart,
					}),
				],
			});


			
			

			var data = chartData;

			valueSeries.data.setAll(data);
			volumeSeries.data.setAll(data);

			' . "\n";

		if (esc_attr($atts['ssb']) == 1) {
			$html .= 'sbSeries.data.setAll(data);' . "\n";
		}


		$html .= '</script>' . "\n";

		// print_r($html);
		// exit();
		return $html;
	}
	
	
	
	/**
	*********************************************************************************
	 * Define the stock plugin shortcode
	 * @since  1.6.2
	 * @return string
	*********************************************************************************
	 */
	public function calculator_shortcode( $atts ) {
		$html = '';
		$atts = shortcode_atts(
			array(
				's' => '',
				'class' => '',
				'css' => ''
			),
			$atts
		);
		
		$ticker = $this->ticker;
		if(esc_attr( $atts['s'])!=''){
			$ticker = esc_attr( $atts['s']);
		}

		$html .= '<div data-qmod-tool="investmentcalculator" data-qmod-params=\'{"symbol":"' . $ticker . '","lang":"en"}\'  class="qtool b2iCalcContainer ' . $atts['class'] . '"></div>';
		$html .= '<script  id="qmod"  type="application/javascript"  src="https://qmod.quotemedia.com/js/qmodLoader.js"  data-qmod-wmid="90308"></script>';

		return $html;
	}


	
	/**
	*********************************************************************************
	 * Define the Event Viewer plugin shortcode
	 * @since  1.0.5
	 * @return string
	*********************************************************************************
	 */
	public function cal_view_shortcode2( $atts ) {
		$html = '';
		$atts = shortcode_atts(
			array(
				'sdiv' => '',
				'bizid' => '',
				'api' => '',
				'h' => 'https',
				'g' => '',
				'c' => '1',
				'y' => '',
				'tl' => '',
				'm' => '',
				'df' => '0',
				'dlo' => '0',
				'lo' => '',
				'class' => '',
				'a' => ''
			),
			$atts
		);
		
		
		$bizid = $this->business_id;
		$api = $this->key;
		if(esc_attr( $atts['bizid'])!='' && esc_attr( $atts['api'])!=''){
			$bizid = esc_attr( $atts['bizid']);
			$api = esc_attr( $atts['api']);
		}
		
		
		$url2 = esc_attr( $atts['h'] ) . $this->base_url2 . 'CalViewFeed.asp?b=' . $this->business_id . '&api='. $this->key . "&m=" . esc_attr( $atts['m'] ) . "&lo=" . esc_attr( $atts['lo'] );
		
		//. '&g='. esc_attr( $atts['group'] ) ;
		if(isset($_REQUEST['id'])){
			if($_REQUEST['id']!='') $url2 .= '&id=' . $_REQUEST['id'];
		}
		
		if ( $atts['c']!='' ) $url2 .= '&c='. esc_attr( $atts['c'] );
		if ( $atts['y']!='' ) $url2 .= '&y='. esc_attr( $atts['y'] );
		if ( $atts['tl']!='' ) $url2 .= '&tl='. esc_attr( $atts['tl'] );
		if ( $atts['df']!='0' ) $url2 .= '&df='. esc_attr( $atts['df'] );	
		if ( $atts['dlo']!='0' ) $url2 .= '&dlo='. esc_attr( $atts['dlo'] );		
		//print($url2);
		
		$contents = file_get_contents($url2);
		//If $contents is not a boolean FALSE value.
		//if($contents !== false){
			//Print out the contents.
			//return $contents;
		//}
		
		
		$html .= '<script src="' . esc_url( esc_attr( $atts['h'] ) . $this->base_url2 . 'CalViewapi.asp?v=' . $this->version ) . '" type="text/javascript"></script>' . "\n";
		$html .= '<script type="text/javascript">' . "\n";
		$html .= 'oCalView.BizID="' . $bizid . '";' . "\n";
		$html .= 'oCalView.sKey="' . $api . '";' . "\n";
		$html .= 'oCalView.sDiv="' . $calviewdivname . '";' . "\n";
		$html .= ( $atts['g'] !== '' ) ? 'oCalView.Group="' . esc_attr( $atts['g'] ) . '";' . "\n" : '';
		$html .= ( $atts['h'] !== '' ) ? 'oCalView.sHttp="' . esc_attr( $atts['h'] ) . '";' . "\n" : '';
		$html .= ( $atts['c'] !== '' ) ? 'oCalView.Count="' . esc_attr( $atts['c'] ) . '";' . "\n" : '';
		$html .= ( $atts['y'] !== '' ) ? 'oCalView.Year="' . esc_attr( $atts['y'] ) . '";' . "\n" : '';
		$html .= ( $atts['m'] !== '' ) ? 'oCalView.Mode="' . esc_attr( $atts['m'] ) . '";' . "\n" : '';
		$html .= ( $atts['tl'] !== '' ) ? 'oCalView.tl="' . esc_attr( $atts['tl'] ) . '";' . "\n" : '';
		$html .= ( $atts['df'] !== '' ) ? 'oCalView.iDateFormat="' . esc_attr( $atts['df'] ) . '";' . "\n" : '';
		$html .= ( $atts['dlo'] !== '' ) ? 'oCalView.iDateLocation="' . esc_attr( $atts['dlo'] ) . '";' . "\n" : '';
		$html .= ( $atts['lo'] !== '' ) ? 'oCalView.lo="' . esc_attr( $atts['lo'] ) . '";' . "\n" : '';
		//$html .= 'getCalViewData();' . "\n";
		$html .= '</script>' . "\n";
		
		$calviewdivname = 'CalViewDiv' . esc_attr( $atts['m'] ) . esc_attr( $atts['y'] );
		if ( $atts['g']!='' ) $calviewdivname = $calviewdivname . esc_attr( $atts['g'] );
		if ( $atts['sdiv']!='' )  $calviewdivname = esc_attr( $atts['sdiv'] );
		$html .= '<div id="' . $calviewdivname . '" class="B2iCalendarViewContainer ' . esc_attr( $atts['class'] ). '">' . $contents . '</div>' . "\n";
		return $html;
	}
	
	

	/**
	 **********************************************************************************
	 * Define the Email Opt-in 3 plugin shortcode  - with Server side data pull
	 * @since  1.06
	 * @return string
	 **********************************************************************************
	 */	
	public function email_optin_shortcode3( $atts ) {
		$html = '';
		$atts = shortcode_atts(
			array(
				'h' => 'https',
				'sdiv' => '',
				'lang' => '',
				'lo' => '',
				'g' => '',
				'it' => '',
				'ca' => '',
				'ha' => '',
				'sep' => '',
				'uep' => '',
				'el' => '',
				'tos' => '',
				'tosl' => '',
				'tosc' => ''
			),
			$atts
		);
		
		$url2 = esc_attr( $atts['h'] ) . $this->base_url3 . 'profiles/investor/EmailAlert3.asp?b=' . $this->business_id . '&api='. $this->key ;
	
		$url2 .= ( $atts['lang']!== '' ) ? '&l='. esc_attr( $atts['lang'] ) : '&l=1';
		if ( $atts['lo']!='' ) $url2 .= '&lo='. esc_attr( $atts['lo'] );
		if ( $atts['g']!='' ) $url2 .= '&g='. esc_attr( $atts['g'] );
		if ( $atts['it']!='' ) $url2 .= '&l='. esc_attr( $atts['it'] );
		if ( $atts['ca']!='' ) $url2 .= '&ca='. esc_attr( $atts['ca'] );
		if ( $atts['ha']!='' ) $url2 .= '&ha='. esc_attr( $atts['ha'] );
		if ( $atts['el']!='' ) $url2 .= '&le='. esc_attr( $atts['el'] );
		if ( $atts['tos']!='' ) $url2 .= '&tos='. esc_attr( $atts['tos'] );
		if ( $atts['tosl']!='' ) $url2 .= '&tosl='. esc_attr( $atts['tosl'] );
		if ( $atts['tosc']!='' ) $url2 .= '&tosc='. esc_attr( $atts['tosc'] );
		//return $url2;
		
		$html .= '<script src="' . esc_attr( $atts['h'] ) . $this->base_url2 . 'Emailapi3.asp?';
		if ( $atts['lang']!='' ) $html .= 'lang=' . esc_attr( $atts['lang'] ) . "&";
		$html .= 'v=' . $this->version . '" type="text/javascript"></script>' . "\n";
		$html .= '<script type="text/javascript">' . "\n";
		$html .= 'oEmail.BizID="' . $this->business_id . '";' . "\n";
		$html .= 'oEmail.sKey="' . $this->key . '";' . "\n";
		$html .= ( $atts['h'] !== '' ) ? 'oEmail.sHttp="' . esc_attr( $atts['h'] ) . '";' . "\n" : '';
		$html .= ( $atts['lang'] !== '' ) ? 'oEmail.LangID="' . esc_attr( $atts['lang'] ) . '";' . "\n" : '';
		$html .= ( $atts['sdiv'] !== '' ) ? 'oEmail.sDiv="' . esc_attr( $atts['sdiv'] ) . '";' . "\n" : '';
		$html .= ( $atts['lo'] !== '' ) ? 'oEmail.lo="' . esc_attr( $atts['lo'] ) . '";' . "\n" : '';
		$html .= ( $atts['it'] !== '' ) ? 'oEmail.InvTag="' . esc_attr( $atts['it'] ) . '";' . "\n" : '';
		$html .= ( $atts['ca'] !== '' ) ? 'oEmail.CheckAllList="' . esc_attr( $atts['ca'] ) . '";' . "\n" : '';
		$html .= ( $atts['ha'] !== '' ) ? 'oEmail.HideAllList="' . esc_attr( $atts['ha'] ) . '";' . "\n" : '';
		$html .= ( $atts['sep'] !== '' ) ? 'oEmail.sJoinEndPoint="' . esc_attr( $atts['sep'] ) . '";' . "\n" : '';
		$html .= ( $atts['uep'] !== '' ) ? 'oEmail.sRemoveEndPoint="' . esc_attr( $atts['uep'] ) . '";' . "\n" : '';
		$html .= ( $atts['el'] !== '' ) ? 'oEmail.LabelEmail="' . esc_attr( $atts['el'] ) . '";' . "\n" : '';
		$html .= ( $atts['tos'] !== '' ) ? 'oEmail.tos="' . esc_attr( $atts['tos'] ) . '";' . "\n" : '';
		$html .= ( $atts['tosl'] !== '' ) ? 'oEmail.tosLabel="' . esc_attr( $atts['tosl'] ) . '";' . "\n" : '';
		$html .= ( $atts['tosc'] !== '' ) ? 'oEmail.tosControl="' . esc_attr( $atts['tosc'] ) . '";' . "\n" : '';
		$html .= '</script>' . "\n";
		//return $html;
		
		
		$contents = file_get_contents($url2);
		//If $contents is not a boolean FALSE value.
		//if($contents !== false){
			//Print out the contents.
		//	return $contents;
		//}
		$emaildivname = 'EmailDiv';		
		if ( $atts['sdiv']!='' ) $emaildivname = esc_attr( $atts['sdiv'] );
		$html .= '<div id="' . $emaildivname . '">' . $contents . '</div>' . "\n";
		return $html;
	}
	


	/**
	 **********************************************************************************
	 * Define the Email Opt-in 2 plugin shortcode
	 * @since  0.8.3
	 * @return string
	 **********************************************************************************
	 */
	public function email_optin_shortcode2( $atts ) {
		$html = '';
		$atts = shortcode_atts(
			array(
				'bizid' => '',
				'api' => '',
				'list' => '',
				'listsort' => '',
				'h' => 'https',
				'sdiv' => '',
				'g' => '',
				'sc' => '',
				'sn' => '',
				'rn' => '',
				'it' => '',
				'ca' => '',
				'ha' => '',
				'sep' => '',
				'uep' => '',
				'lo' => '',
				'el' => '',
				'lang' => '',
				'class' => '',
				'tos' => '',
				'tosl' => '',
				'tosc' => '',
				'st' => '',
				'ut' => ''
			),
			$atts
		);
		
		$bizid = $this->business_id;
		$api = $this->key;
		if(esc_attr( $atts['bizid'])!='' && esc_attr( $atts['api'])!=''){
			$bizid = esc_attr( $atts['bizid']);
			$api = esc_attr( $atts['api']);
		}
		
		$emaildivname = 'EmailDiv';		
		if ( $atts['sdiv']!='' ) $emaildivname = esc_attr( $atts['sdiv'] );
		
		$html .= '<div id="' . $emaildivname . '" class="b2iEmailContainer ' . $atts['class'] . '"></div>' . "\n";
		$html .= '<script src="' . esc_attr( $atts['h'] ) . $this->base_url2 . 'Emailapi2.asp?';
		if ( $atts['lang']!='' ) $html .= 'lang=' . esc_attr( $atts['lang'] ) . "&";
		$html .= 'v=' . $this->version . '" type="text/javascript"></script>' . "\n";
		$html .= '<script type="text/javascript">' . "\n";
		$html .= 'oEmail.BizID="' . $bizid . '";' . "\n";
		$html .= 'oEmail.sKey="' . $api . '";' . "\n";
		$html .= ( $atts['h'] !== '' ) ? 'oEmail.sHttp="' . esc_attr( $atts['h'] ) . '";' . "\n" : '';
		$html .= ( $atts['sdiv'] !== '' ) ? 'oEmail.sDiv="' . esc_attr( $atts['sdiv'] ) . '";' . "\n" : '';
		$html .= ( $atts['g'] !== '' ) ? 'oEmail.Group="' . esc_attr( $atts['g'] ) . '";' . "\n" : '';
		$html .= ( $atts['list'] !== '' ) ? 'oEmail.List="' . esc_attr( $atts['list'] ) . '";' . "\n" : '';
		$html .= ( $atts['listsort'] !== '' ) ? 'oEmail.ListSort="' . esc_attr( $atts['listsort'] ) . '";' . "\n" : '';
		$html .= ( $atts['sc'] !== '' ) ? 'oEmail.ShowCompany="' . esc_attr( $atts['sc'] ) . '";' . "\n" : '';
		$html .= ( $atts['sn'] !== '' ) ? 'oEmail.ShowName="' . esc_attr( $atts['sn'] ) . '";' . "\n" : '';
		$html .= ( $atts['rn'] == '0' ) ? 'oEmail.RequiredName="false";' . "\n" : '';
		$html .= ( $atts['ca'] !== '' ) ? 'oEmail.CheckAllList="' . esc_attr( $atts['ca'] ) . '";' . "\n" : '';
		$html .= ( $atts['ha'] !== '' ) ? 'oEmail.HideAllList="' . esc_attr( $atts['ha'] ) . '";' . "\n" : '';
		$html .= ( $atts['it'] !== '' ) ? 'oEmail.InvTag="' . esc_attr( $atts['it'] ) . '";' . "\n" : '';
		$html .= ( $atts['sep'] !== '' ) ? 'oEmail.sJoinEndPoint="' . esc_attr( $atts['sep'] ) . '";' . "\n" : '';
		$html .= ( $atts['uep'] !== '' ) ? 'oEmail.sRemoveEndPoint="' . esc_attr( $atts['uep'] ) . '";' . "\n" : '';
		$html .= ( $atts['lo'] !== '' ) ? 'oEmail.lo="' . esc_attr( $atts['lo'] ) . '";' . "\n" : '';
		$html .= ( $atts['el'] !== '' ) ? 'oEmail.LabelEmail="' . esc_attr( $atts['el'] ) . '";' . "\n" : '';
		$html .= ( $atts['lang'] !== '' ) ? 'oEmail.LangID="' . esc_attr( $atts['lang'] ) . '";' . "\n" : '';
		$html .= ( $atts['tos'] !== '' ) ? 'oEmail.tos="' . esc_attr( $atts['tos'] ) . '";' . "\n" : '';
		$html .= ( $atts['tosl'] !== '' ) ? 'oEmail.tosLabel="' . esc_attr( $atts['tosl'] ) . '";' . "\n" : '';
		$html .= ( $atts['tosc'] !== '' ) ? 'oEmail.tosControl="' . esc_attr( $atts['tosc'] ) . '";' . "\n" : '';
		$html .= ( $atts['st'] !== '' ) ? 'oEmail.sSubscribeText="' . esc_attr( $atts['st'] ) . '";' . "\n" : '';
		$html .= ( $atts['ut'] !== '' ) ? 'oEmail.sUnsubscribeText="' . esc_attr( $atts['ut'] ) . '";' . "\n" : '';
		$html .= 'getEmailAlertData();' . "\n";
		$html .= '</script>' . "\n";
		return $html;
	}




	public function email_unsubscribe_shortcode( $atts ) {
		$html = '';
		$atts = shortcode_atts(
			array(
				'bizid' => '',
				'api' => '',
				'h' => 'https',
				'sdiv' => '',
				'uep' => '',
				'lo' => '',
				'le' => '',
				'lu' => '',
				'lang' => '',
				'class' => '',
				'tos' => '',
				'tosl' => '',
				'tosc' => '',
				'ut' => ''
			),
			$atts
		);
		
		$bizid = $this->business_id;
		$api = $this->key;
		if(esc_attr( $atts['bizid'])!='' && esc_attr( $atts['api'])!=''){
			$bizid = esc_attr( $atts['bizid']);
			$api = esc_attr( $atts['api']);
		}
		
		$emaildivname = 'EmailUnDiv';		
		if ( $atts['sdiv']!='' ) $emaildivname = esc_attr( $atts['sdiv'] );
		
		$html .= '<div id="' . $emaildivname . '" class="b2iEmailUnContainer ' . $atts['class'] . '"></div>' . "\n";
		$html .= '<script src="' . esc_attr( $atts['h'] ) . $this->base_url2 . 'EmailUnapi2.asp?';
		if ( $atts['lang']!='' ) $html .= 'lang=' . esc_attr( $atts['lang'] ) . "&";
		$html .= 'v=' . $this->version . '" type="text/javascript"></script>' . "\n";
		$html .= '<script type="text/javascript">' . "\n";
		$html .= 'oEmailUn.BizID="' . $bizid . '";' . "\n";
		$html .= 'oEmailUn.sKey="' . $api . '";' . "\n";
		$html .= ( $atts['h'] !== '' ) ? 'oEmailUn.sHttp="' . esc_attr( $atts['h'] ) . '";' . "\n" : '';
		$html .= ( $atts['sdiv'] !== '' ) ? 'oEmailUn.sDiv="' . esc_attr( $atts['sdiv'] ) . '";' . "\n" : '';
		$html .= ( $atts['uep'] !== '' ) ? 'oEmailUn.sRemoveEndPoint="' . esc_attr( $atts['uep'] ) . '";' . "\n" : '';
		$html .= ( $atts['lo'] !== '' ) ? 'oEmailUn.lo="' . esc_attr( $atts['lo'] ) . '";' . "\n" : '';
		$html .= ( $atts['le'] !== '' ) ? 'oEmailUn.LabelEmail="' . esc_attr( $atts['le'] ) . '";' . "\n" : '';
		$html .= ( $atts['lu'] !== '' ) ? 'oEmailUn.LabelUnsubscribe="' . esc_attr( $atts['lu'] ) . '";' . "\n" : '';
		$html .= ( $atts['lang'] !== '' ) ? 'oEmailUn.LangID="' . esc_attr( $atts['lang'] ) . '";' . "\n" : '';
		$html .= ( $atts['tos'] !== '' ) ? 'oEmailUn.tos="' . esc_attr( $atts['tos'] ) . '";' . "\n" : '';
		$html .= ( $atts['tosl'] !== '' ) ? 'oEmailUn.tosLabel="' . esc_attr( $atts['tosl'] ) . '";' . "\n" : '';
		$html .= ( $atts['tosc'] !== '' ) ? 'oEmailUn.tosControl="' . esc_attr( $atts['tosc'] ) . '";' . "\n" : '';
		$html .= ( $atts['ut'] !== '' ) ? 'oEmailUn.sUnsubscribeText="' . esc_attr( $atts['ut'] ) . '";' . "\n" : '';
		$html .= 'getEmailUnData();' . "\n";
		$html .= '</script>' . "\n";
		return $html;
	}







	/**
	 **********************************************************************************
	 * Define the Email Opt-in plugin shortcode
	 * @since  0.7. ?
	 * @return string
	 **********************************************************************************
	 */
	public function email_optin_shortcode( $atts ) {
		$html = '';
		$atts = shortcode_atts(
			array(
				'h' => 'https',
				'sdiv' => '',
				'g' => '',
				'lang' => '',
				'isw' => '',
				'ish' => ''
			),
			$atts
		);

		$emaildivname = 'EmailDiv';		
		if ( $atts['sdiv']!='' ) $emaildivname = esc_attr( $atts['sdiv'] );
		$html .= '<div id="' . $emaildivname . '"></div>' . "\n";
		$html .= '<script src="' . esc_url(esc_attr( $atts['h'] ) . $this->base_url2 . 'EmailApi.js?v=' . $this->version ) . '" type="text/javascript"></script>' . "\n";
		$html .= '<script type="text/javascript">' . "\n";
		$html .= 'oEmail.BizID="' . $this->business_id . '";' . "\n";
		$html .= 'oEmail.sKey="' . $this->key . '";' . "\n";
		$html .= ( $atts['h'] !== '' ) ? 'oEmail.sHttp="' . esc_attr( $atts['h'] ) . '";' . "\n" : '';
		$html .= ( $atts['sdiv'] !== '' ) ? 'oEmail.sDiv="' . esc_attr( $atts['sdiv'] ) . '";' . "\n" : '';
		$html .= ( $atts['g'] !== '' ) ? 'oEmail.Group="' . esc_attr( $atts['g'] ) . '";' . "\n" : '';
		$html .= ( $atts['lang'] !== '' ) ? 'oEmail.LangID="' . esc_attr( $atts['lang'] ) . '";' . "\n" : '';
		$html .= ( $atts['isw'] !== '' ) ? 'oEmail.iStoryWidth="' . esc_attr( $atts['isw'] ) . '";' . "\n" : '';
		$html .= ( $atts['ish'] !== '' ) ? 'oEmail.iStoryHeight="' . esc_attr( $atts['ish'] ) . '";' . "\n" : '';
		$html .= 'getEmailData();' . "\n";
		$html .= '</script>' . "\n";
		return $html;
	}


	
	/**
	*********************************************************************************
	 * Define the SEC plugin shortcode
	 * @since  0.1.0
	 * @return string
	*********************************************************************************
	 */
	public function sec_shortcode( $atts ) {
		$secdivname = $this->base_secdivname;
		$html = '';
		$atts = shortcode_atts(
			array(
				'bizid' => '',
				'api' => '',
				'y' => '',
				't' => '',
				'sdiv' => '',
				'o' => 'default',
				'c' => '',
				'n' => '',
				'h' => 'https',
				'fonticons' => '',
				'ol' => '',
				'oi' => '',
				'sf' => '',
				'sh' => '',
				'topnav' => '',
				'sd' => '',
				'sg' => '',
				'lo' => '1',
				'isw' => '',
				'ish' => '',
				'ismw' => '',
				'ismh' => '',
				'ilo' => '',
				'ito' => '',
				'th' => '',
				'v' => '',
				'cy' => '',
				'spdf' => '',
				'shtm' => '',
				'sdoc' => '',
				'sxls' => '',
				'sxbrl' => '',
				'szip' => '',
				'class' => '',
				'hash' => ''
				
			),
			$atts
		);
		
		$bizid = $this->business_id;
		$api = $this->key;
		if(esc_attr( $atts['bizid'])!='' && esc_attr( $atts['api'])!=''){
			$bizid = esc_attr( $atts['bizid']);
			$api = esc_attr( $atts['api']);
		}
		
		if ( $atts['t']!='' ) $secdivname = $secdivname . esc_attr( $atts['t'] );
		if ( $atts['sdiv']!='' ) $secdivname = esc_attr( $atts['sdiv'] );
		
		$html .= '<div id="' . $secdivname . '" class="b2iSecContainer ' . $atts['class'] . '"></div>' . "\n";
		$html .= '<script src="' . esc_url( esc_attr( $atts['h'] ) . $this->base_url2 . 'SECapi.js?v=' . $this->version ) . '" type="text/javascript"></script>' . "\n";
		$html .= '<script type="text/javascript">' . "\n";
		$html .= 'oSEC.BizID="' . $bizid. '";' . "\n";
		$html .= 'oSEC.sKey="' . $api . '";' . "\n";
		$html .= ( $atts['y'] !== '' ) ? 'oSEC.y="' . esc_attr( $atts['y'] ) . '";' . "\n" : '';
		$html .= ( $atts['t'] !== '' ) ? 'oSEC.t="' . esc_attr( $atts['t'] ) . '";' . "\n" : '';
		$html .= 'oSEC.sDiv="' . $secdivname . '";' . "\n";
		$html .= ( $atts['o'] !== '' ) ? 'oSEC.o="' . esc_attr( $atts['o'] ) . '";' . "\n" : '';
		$html .= ( $atts['c'] !== '' ) ? 'oSEC.c="' . esc_attr( $atts['c'] ) . '";' . "\n" : '';
		$html .= ( $atts['n'] !== '' ) ? 'oSEC.n="' . esc_attr( $atts['n'] ) . '";' . "\n" : '';
		$html .= ( $atts['h'] !== '' ) ? 'oSEC.sHttp="' . esc_attr( $atts['h'] ) . '";' . "\n" : '';
		$html .= ( $atts['sf'] !== '' ) ? 'oSEC.sf="' . esc_attr( $atts['sf'] ) . '";' . "\n" : '';
		$html .= ( $atts['sh'] !== '' ) ? 'oSEC.sh="' . esc_attr( $atts['sh'] ) . '";' . "\n" : '';
		$html .= ( $atts['topnav'] !== '' ) ? 'oSEC.topnav="' . esc_attr( $atts['tn'] ) . '";' . "\n" : '';
		$html .= ( $atts['sd'] !== '' ) ? 'oSEC.sd="' . esc_attr( $atts['sd'] ) . '";' . "\n" : '';
		$html .= ( $atts['sg'] !== '' ) ? 'oSEC.sg="' . esc_attr( $atts['sg'] ) . '";' . "\n" : '';
		$html .= ( $atts['lo'] !== '' ) ? 'oSEC.lo="' . esc_attr( $atts['lo'] ) . '";' . "\n" : '';
		$html .= ( $atts['spdf'] !== '' ) ? 'oSEC.sPdf="' . esc_attr( $atts['spdf'] ) . '";' . "\n" : '';
		$html .= ( $atts['shtm'] !== '' ) ? 'oSEC.sHtm="' . esc_attr( $atts['shtm'] ) . '";' . "\n" : '';
		$html .= ( $atts['sdoc'] !== '' ) ? 'oSEC.sDoc="' . esc_attr( $atts['sdoc'] ) . '";' . "\n" : '';
		$html .= ( $atts['sxls'] !== '' ) ? 'oSEC.sXls="' . esc_attr( $atts['sxls'] ) . '";' . "\n" : '';
		$html .= ( $atts['sxbrl'] !== '' ) ? 'oSEC.sXbrl="' . esc_attr( $atts['sxbrl'] ) . '";' . "\n" : '';
		$html .= ( $atts['szip'] !== '' ) ? 'oSEC.sZip="' . esc_attr( $atts['szip'] ) . '";' . "\n" : '';
		$html .= ( $atts['fonticons'] !== '' ) ? 'oSEC.fonticon="' . esc_attr( $atts['fonticons'] ) . '";' . "\n" : '';
		$html .= ( $atts['ol'] !== '' ) ? 'oSEC.OpenLinks="' . esc_attr( $atts['ol'] ) . '";' . "\n" : '';
		$html .= ( $atts['oi'] !== '' ) ? 'oSEC.OpenIcons="' . esc_attr( $atts['oi'] ) . '";' . "\n" : '';
		$html .= ( $atts['th'] !== '' ) ? 'oSEC.TextHeader="' . esc_attr( $atts['th'] ) . '";' . "\n" : '';
		$html .= ( $atts['isw'] !== '' ) ? 'oSEC.iStoryWidth="' . esc_attr( $atts['isw'] ) . '";' . "\n" : '';
		$html .= ( $atts['ish'] !== '' ) ? 'oSEC.iStoryHeight="' . esc_attr( $atts['ish'] ) . '";' . "\n" : '';
		$html .= ( $atts['ismw'] !== '' ) ? 'oSEC.iStoryMaxWidth="' . esc_attr( $atts['ismw'] ) . '";' . "\n" : '';
		$html .= ( $atts['ismh'] !== '' ) ? 'oSEC.iStoryMaxHeight="' . esc_attr( $atts['ismh'] ) . '";' . "\n" : '';
		$html .= ( $atts['ilo'] !== '' ) ? 'oSEC.iLeftOffset="' . esc_attr( $atts['ilo'] ) . '";' . "\n" : '';
		$html .= ( $atts['ito'] !== '' ) ? 'oSEC.iTopOffset="' . esc_attr( $atts['ito'] ) . '";' . "\n" : '';
		$html .= ( $atts['v'] !== '' ) ? 'oSEC.SecVer="' . esc_attr( $atts['v'] ) . '";' . "\n" : '';
		$html .= ( $atts['cy'] !== '' ) ? 'oSEC.currentyear="' . esc_attr( $atts['cy'] ) . '";' . "\n" : '';
		$html .= ( $atts['hash'] !== '' ) ? 'oSEC.sHash="' . esc_attr( $atts['hash'] ) . '";' . "\n" : '';
		$html .= 'getSecData();' . "\n";
		$html .= '</script>' . "\n";
		return $html;
	}




	public function sec_view_shortcode( $atts ) {
		$html = '';
		$url2 = '';
		$libdivname = $this->base_libviewdivname;
		$atts = shortcode_atts(
			array(
				'group' => '',
				'h' => 'https',
				'sdiv' => '',    // list div name, set when using multiple on same page
				'd' => '',     // date - controls location
				'df' => '',    // dateformat
				'sb' => '',    // Show back
				'o' => '',     // output type div
				't' => '',     // tag id
				'f' => '',     // filter id
				'tl' => '',    // show tools - tags ddl and search box
				'ut' => '', 	//use template
				'css' => '',   // set to 0 to turn off default css
				'rss' => '',	//display rss button
				'class' => '',
				'server' => ''
			),
			$atts
		);
		
		$url2 = esc_attr( $atts['h'] ) . $this->base_url2 . 'LibraryView.asp?b=' . $this->business_id . '&api='. $this->key ;
		if(esc_attr( $atts['group'] )!='') $url2 .= '&g=' . esc_attr( $atts['group'] );
		
		
		if(isset($_REQUEST['i'])){
			if($_REQUEST['i']!='') $url2 .= '&id=' . $_REQUEST['i'];
		}
		
		if ( $atts['sb']!='' ) $url2 .= '&sb=1';
		
		
		$url2 = "https://dd7pmep5szm19.cloudfront.net/449/0001209191-22-049522.htm";
		
		$contents = file_get_contents($url2);
		//If $contents is not a boolean FALSE value.
		if($contents !== false){
			//Print out the contents.
			//return $contents;
		}
		
		$libdivname .= esc_attr( $atts['group'] ) ;
		if ( $atts['sdiv']!='' ) $libdivname = esc_attr( $atts['sdiv'] );
		$html .= '<style>#b2iTopTools{display:none;}</style><div id="' . $libdivname . '" class="B2iSecViewContainer ' . $atts['class'] . '" style="*{all: unset;}">' . $contents . '</div>' . "\n";
		return $html;
	}
	
	
	
	/**
	 **********************************************************************************
	 * Define the Library plugin shortcode
	 * @since  0.1.0
	 * @return string
	 **********************************************************************************
	 */
	public function press_releases_shortcode( $atts ) {
		$html = '';
		$libdivname = $this->base_libdivname;
		
		
		$atts = shortcode_atts(
			array(
				'bizid' => '',
				'api' => '',
				'group' => '',
				'h' => 'https',
				'sdiv' => '',    // list div name, set when using multiple on same page
				'sdn' => '',   // story div name, set to the list div name
				'n' => '',     // show navigation/paging
				'c' => '',     // count
				'd' => '',     // date - controls location
				'df' => '',    // dateformat
				'sb' => '',    // Show back
				'se' => '',    // Show expand set to 1, allows story to show in div under the headline
				'sd' => '',    // allows story to consume list div
				'su' => '',    // Show summary, set to number of characters of PR body to display
				'o' => '',     // output type table div
				't' => '',     // tag id
				'f' => '',     // filter id
				'isw' => '',   // floating div story width
				'ish' => '',   // floating div story height
				'ismw' => '',  // floating div story MAX width
				'ismh' => '',  // floating div story MAX height
				'ilo' => '',   // floating div story left offset
				'ito' => '',   // floating div story top offset
				'a' => '', 	   // set to 1 to use a link instead of target div
				'tl' => '',    // show tools - tags ddl and search box
				'ut' => '', 	//use template
				'pd' => '1',   // use popout div
				'css' => '',   // set to 0 to turn off default css
				'rss' => '',	//display rss button
				'ln' => '', 	// set Headline length
				'y' => '', 	   // year filter
				'off' => '',	// offset - 08-17-23
				'viewlink' => '',
				'class' => '',
				'server' => 'www.b2i.us'
			),
			$atts
		);
		
		
		$bizid = $this->business_id;
		$api = $this->key;
		if(esc_attr( $atts['bizid'])!='' && esc_attr( $atts['api'])!=''){
			$bizid = esc_attr( $atts['bizid']);
			$api = esc_attr( $atts['api']);
		}
		
		// $base_libdivname
		$libdivname .= esc_attr( $atts['group'] ) ;
		
		if ( $atts['sdiv']!='' ) $libdivname = esc_attr( $atts['sdiv'] );
		
		if ( $atts['pd']=='0' ) $html .= '<a name="Lib' . esc_attr( $atts['group'] ) . '"></a><span id="DisplayListDiv1" style="display:none;"><a href="Javascript:document.location=\'#Lib65\'; getData();">Display list</a></span>' . "\n";
		$html .= '<div id="' . $libdivname . '" class="b2iPressContainer ' . $atts['class'] . '"></div>' . "\n";
		$html .= '<script src="' . esc_url(esc_attr( $atts['h'] ) . '://' . esc_attr( $atts['server'] ) . '/b2i/LibraryApi.js?v=' . $this->version ) . '" type="text/javascript"></script>' . "\n";
		$html .= '<script type="text/javascript">' . "\n";
		$html .= 'oLib.BizID="' . $bizid . '";' . "\n";
		$html .= 'oLib.sKey="' . $api . '";' . "\n";
		$html .= 'oLib.Group="' . esc_attr( $atts['group'] ) . '";' . "\n";
		$html .= 'oLib.sDiv="' . $libdivname . '";' . "\n";
		$html .= ( $atts['sdn'] !== '' ) ? 'oLib.sStoryDiv="' . esc_attr( $atts['sdn'] ) . '";' . "\n" : '';
		if ( $atts['sd']!='' ) $html .= 'oLib.sStoryDiv=oLib.sDiv' . "\n";
		if ( $atts['sd']!='' ) $html .= 'oLib.ShowBack="1";' . "\n";
		if ( $atts['sd']!='' ) $html .= 'oLib.iPopoutDiv="0";' . "\n";
		$html .= ( $atts['h'] !== '' ) ? 'oLib.sHttp="' . esc_attr( $atts['h'] ) . '";' . "\n" : '';
		$html .= ( $atts['c'] !== '' ) ? 'oLib.Count="' . esc_attr( $atts['c'] ) . '";' . "\n" : '';
		$html .= ( $atts['d'] !== '' ) ? 'oLib.ShowDate="' . esc_attr( $atts['d'] ) . '";' . "\n" : '';
		$html .= ( $atts['df'] !== '' ) ? 'oLib.iDateFormat="' . esc_attr( $atts['df'] ) . '";' . "\n" : '';
		$html .= ( $atts['se'] !== '' ) ? 'oLib.ShowExpand="' . esc_attr( $atts['se'] ) . '";' . "\n" : '';
		$html .= ( $atts['su'] !== '' ) ? 'oLib.ShowSummary="' . esc_attr( $atts['su'] ) . '";' . "\n" : '';
		$html .= ( $atts['n'] !== '' ) ? 'oLib.sNav="' . esc_attr( $atts['n'] ) . '";' . "\n" : '';
		$html .= ( $atts['o'] !== '' ) ? 'oLib.Output="' . esc_attr( $atts['o'] ) . '";' . "\n" : '';
		$html .= ( $atts['t'] !== '' ) ? 'oLib.Tag="' . esc_attr( $atts['t'] ) . '";' . "\n" : '';
		$html .= ( $atts['f'] !== '' ) ? 'oLib.Filter="' . esc_attr( $atts['f'] ) . '";' . "\n" : '';
		$html .= ( $atts['isw'] !== '' ) ? 'oLib.iStoryWidth="' . esc_attr( $atts['isw'] ) . '";' . "\n" : '';
		$html .= ( $atts['ish'] !== '' ) ? 'oLib.iStoryHeight="' . esc_attr( $atts['ish'] ) . '";' . "\n" : '';
		$html .= ( $atts['ismw'] !== '' ) ? 'oLib.iStoryMaxWidth="' . esc_attr( $atts['ismw'] ) . '";' . "\n" : '';
		$html .= ( $atts['ismh'] !== '' ) ? 'oLib.iStoryMaxHeight="' . esc_attr( $atts['ismh'] ) . '";' . "\n" : '';
		$html .= ( $atts['ilo'] !== '' ) ? 'oLib.iLeftOffset="' . esc_attr( $atts['ilo'] ) . '";' . "\n" : '';
		$html .= ( $atts['ito'] !== '' ) ? 'oLib.iTopOffset="' . esc_attr( $atts['ito'] ) . '";' . "\n" : '';
		$html .= ( $atts['a'] !== '' ) ? 'oLib.Alink="' . esc_attr( $atts['a'] ) . '";' . "\n" : '';
		$html .= ( $atts['tl'] !== '' ) ? 'oLib.sTools="' . esc_attr( $atts['tl'] ) . '";' . "\n" : '';
		$html .= ( $atts['ut'] !== '' ) ? 'oLib.UseTemplate="' . esc_attr( $atts['ut'] ) . '";' . "\n" : '';
		$html .= ( $atts['css'] !== '' ) ? 'oLib.CSS="' . esc_attr( $atts['css'] ) . '";' . "\n" : '';
		$html .= ( $atts['ln'] !== '' ) ? 'oLib.HeadlineLen="' . esc_attr( $atts['ln'] ) . '";' . "\n" : '';
		$html .= ( $atts['y'] !== '' ) ? 'oLib.Year="' . esc_attr( $atts['y'] ) . '";' . "\n" : '';
		$html .= ( $atts['off'] !== '' ) ? 'oLib.Offset="' . esc_attr( $atts['off'] ) . '";' . "\n" : '';
		/* $html .= ( $atts['pd'] !== '' ) ? 'oLib.iPopoutDiv="' . esc_attr( $atts['pd'] ) . '";' . "\n" : ''; */
		$html .= ( $atts['rss'] !== '' ) ? 'oLib.RSS="' . esc_attr( $atts['rss'] ) . '";' . "\n" : '';
		$html .= ( $atts['viewlink'] !== '' ) ? 'oLib.ViewLink="' . esc_attr( $atts['viewlink'] ) . '";' . "\n" : '';
		$html .= ( $atts['server'] !== '' ) ? 'oLib.sServer="' . esc_attr( $atts['server'] ) . '";' . "\n" : '';
		$html .= 'getData();' . "\n";
		$html .= '</script>' . "\n";
		/*
		if ( $atts['pd']==0 ) $html .= '<span id="DisplayListDiv2" style="display:none;"><a href="Javascript:document.location=\'#Lib65\'; getData();">Display list</a></span>' . "\n"; 
		*/
		return $html;
	}

	
	
	/**
	 **********************************************************************************
	 * Define the Library plugin shortcode
	 * @since  0.1.0
	 * @return string
	 **********************************************************************************
	 */
	public function press_releases_shortcode2( $atts ) {
		$html = '';
		$libdivname = $this->base_libdivname;
		$atts = shortcode_atts(
			array(
				'group' => '',
				'h' => 'https',
				'bizid' => '',
				'api' => '',
				'sdiv' => '',    // list div name, set when using multiple on same page
				'sdn' => '',   // story div name, set to the list div name
				'n' => '',     // show navigation/paging
				'c' => '',     // count
				'd' => '',     // date - controls location
				'df' => '',    // dateformat
				'sb' => '',    // Show back
				's' => '0',    // Site
				'se' => '',    // Show expand set to 1, allows story to show in div under the headline
				'sd' => '',    // allows story to consume list div
				'su' => '',    // Show summary, set to number of characters of PR body to display
				'o' => '',     // output type table div
				't' => '',     // tag id
				'f' => '',     // filter id
				'isw' => '',   // floating div story width
				'ish' => '',   // floating div story height
				'ismw' => '',  // floating div story MAX width
				'ismh' => '',  // floating div story MAX height
				'ilo' => '',   // floating div story left offset
				'ito' => '',   // floating div story top offset
				'a' => '0', 	   // set to 1 to use a link instead of target div
				'tl' => '',    // show tools - tags ddl and search box
				'ut' => '', 	//use template
				'pd' => '1',   // use popout div
				'css' => '',   // set to 0 to turn off default css
				'rss' => '',	//display rss button
				'ln' => '', 	// set Headline length
				'y' => '', 	   // year filter
				'cy' => '', 	   // current year filter
				'off' => '', 	   // current year filter
				'viewlink' => '',
				'class' => '',
				'server' => 'www.b2i.us'
			),
			$atts
		);
		// $base_libdivname
		$libdivname .= esc_attr( $atts['group'] ) ;
		
		$bizid = $this->business_id;
		$api = $this->key;
		if(esc_attr( $atts['bizid'])!='' && esc_attr( $atts['api'])!=''){
			$bizid = esc_attr( $atts['bizid']);
			$api = esc_attr( $atts['api']);
		}
		
		$html .= '<script src="' . esc_url(esc_attr( $atts['h'] ) . '://' . esc_attr( $atts['server'] ) . '/b2i/LibraryApi.js?v=' . $this->version ) . '" type="text/javascript"></script>' . "\n";
		$html .= '<script type="text/javascript">' . "\n";
		$html .= 'oLib.BizID="' . $bizid . '";' . "\n";
		$html .= 'oLib.sKey="' . $api . '";' . "\n";
		$html .= 'oLib.Group="' . esc_attr( $atts['group'] ) . '";' . "\n";
		$html .= 'oLib.sDiv="' . $libdivname . '";' . "\n";
		$html .= ( $atts['sdn'] !== '' ) ? 'oLib.sStoryDiv="' . esc_attr( $atts['sdn'] ) . '";' . "\n" : '';
		if ( $atts['sd']!='' ) $html .= 'oLib.sStoryDiv=oLib.sDiv' . "\n";
		if ( $atts['sd']!='' ) $html .= 'oLib.ShowBack="1";' . "\n";
		if ( $atts['sd']!='' ) $html .= 'oLib.iPopoutDiv="0";' . "\n";
		$html .= ( $atts['h'] !== '' ) ? 'oLib.sHttp="' . esc_attr( $atts['h'] ) . '";' . "\n" : '';
		$html .= ( $atts['c'] !== '' ) ? 'oLib.Count="' . esc_attr( $atts['c'] ) . '";' . "\n" : '';
		$html .= ( $atts['d'] !== '' ) ? 'oLib.ShowDate="' . esc_attr( $atts['d'] ) . '";' . "\n" : '';
		$html .= ( $atts['t'] !== '' ) ? 'oLib.Tag="' . esc_attr( $atts['t'] ) . '";' . "\n" : '';
		$html .= ( $atts['f'] !== '' ) ? 'oLib.Filter="' . esc_attr( $atts['f'] ) . '";' . "\n" : '';
		$html .= ( $atts['n'] !== '' ) ? 'oLib.sNav="' . esc_attr( $atts['n'] ) . '";' . "\n" : '';
		$html .= ( $atts['o'] !== '' ) ? 'oLib.Output="' . esc_attr( $atts['o'] ) . '";' . "\n" : '';
		$html .= ( $atts['y'] !== '' ) ? 'oLib.Year="' . esc_attr( $atts['y'] ) . '";' . "\n" : '';
		$html .= ( $atts['cy'] !== '' ) ? 'oLib.currentyear="' . esc_attr( $atts['cy'] ) . '";' . "\n" : '';
		$html .= ( $atts['tl'] !== '' ) ? 'oLib.sTools="' . esc_attr( $atts['tl'] ) . '";' . "\n" : '';
		$html .= ( $atts['df'] !== '' ) ? 'oLib.iDateFormat="' . esc_attr( $atts['df'] ) . '";' . "\n" : '';
		$html .= ( $atts['a'] !== '' ) ? 'oLib.Alink="' . esc_attr( $atts['a'] ) . '";' . "\n" : '';
		$html .= ( $atts['viewlink'] !== '' ) ? 'oLib.ViewLink="' . esc_attr( $atts['viewlink'] ) . '";' . "\n" : '';
		$html .= ( $atts['css'] !== '' ) ? 'oLib.CSS="' . esc_attr( $atts['css'] ) . '";' . "\n" : '';
		/* $html .= ( $atts['pd'] !== '' ) ? 'oLib.iPopoutDiv="' . esc_attr( $atts['pd'] ) . '";' . "\n" : ''; */
		$html .= ( $atts['rss'] !== '' ) ? 'oLib.RSS="' . esc_attr( $atts['rss'] ) . '";' . "\n" : '';
		$html .= ( $atts['ln'] !== '' ) ? 'oLib.HeadlineLen="' . esc_attr( $atts['ln'] ) . '";' . "\n" : '';
		$html .= ( $atts['off'] !== '' ) ? 'oLib.Offset="' . esc_attr( $atts['off'] ) . '";' . "\n" : '';
		$html .= ( $atts['su'] !== '' ) ? 'oLib.ShowSummary="' . esc_attr( $atts['su'] ) . '";' . "\n" : '';
		
		$html .= ( $atts['se'] !== '' ) ? 'oLib.ShowExpand="' . esc_attr( $atts['se'] ) . '";' . "\n" : '';
		$html .= ( $atts['isw'] !== '' ) ? 'oLib.iStoryWidth="' . esc_attr( $atts['isw'] ) . '";' . "\n" : '';
		$html .= ( $atts['ish'] !== '' ) ? 'oLib.iStoryHeight="' . esc_attr( $atts['ish'] ) . '";' . "\n" : '';
		$html .= ( $atts['ismw'] !== '' ) ? 'oLib.iStoryMaxWidth="' . esc_attr( $atts['ismw'] ) . '";' . "\n" : '';
		$html .= ( $atts['ismh'] !== '' ) ? 'oLib.iStoryMaxHeight="' . esc_attr( $atts['ismh'] ) . '";' . "\n" : '';
		$html .= ( $atts['ilo'] !== '' ) ? 'oLib.iLeftOffset="' . esc_attr( $atts['ilo'] ) . '";' . "\n" : '';
		$html .= ( $atts['ito'] !== '' ) ? 'oLib.iTopOffset="' . esc_attr( $atts['ito'] ) . '";' . "\n" : '';
		$html .= ( $atts['ut'] !== '' ) ? 'oLib.UseTemplate="' . esc_attr( $atts['ut'] ) . '";' . "\n" : '';
		$html .= ( $atts['server'] !== '' ) ? 'oLib.sServer="' . esc_attr( $atts['server'] ) . '";' . "\n" : '';
		$html .= '</script>' . "\n";
		/*
		if ( $atts['pd']==0 ) $html .= '<span id="DisplayListDiv2" style="display:none;"><a href="Javascript:document.location=\'#Lib65\'; getData();">Display list</a></span>' . "\n"; 
		*/
		
		if ( $atts['sdiv']!='' ) $libdivname = esc_attr( $atts['sdiv'] );
		
		$url2 = esc_attr( $atts['h'] ) . $this->base_url2 . 'LibraryFeed.asp?b=' . $bizid . '&api='. $api ;
		
		if(isset($_REQUEST['i'])){
			if($_REQUEST['i']!='') $url2 .= '&id=' . $_REQUEST['i'];
		}
		
		$url2 .= '&div='. $libdivname;
		if ( $atts['s']!='' ) $url2 .= '&s='. esc_attr( $atts['s'] );
		if ( $atts['group']!='' ) $url2 .= '&g='. esc_attr( $atts['group'] );
		if ( $atts['c']!='' ) $url2 .= '&i='. esc_attr( $atts['c'] );
		if ( $atts['d']!='' ) $url2 .= '&sd='. esc_attr( $atts['d'] );
		if ( $atts['t']!='' ) $url2 .= '&t='. esc_attr( $atts['t'] );
		if ( $atts['f']!='' ) $url2 .= '&f='. esc_attr( $atts['f'] );
		if ( $atts['n']!='' ) $url2 .= '&n='. esc_attr( $atts['n'] );
		if ( $atts['o']!='' ) $url2 .= '&out='. esc_attr( $atts['o'] );
		if ( $atts['y']!='' ) $url2 .= '&y='. esc_attr( $atts['y'] );
		if ( $atts['cy']!='' ) $url2 .= '&cy='. esc_attr( $atts['cy'] );
		if ( $atts['tl']!='' ) $url2 .= '&tl='. esc_attr( $atts['tl'] );
		if ( $atts['df']!='' ) $url2 .= '&df='. esc_attr( $atts['df'] );
		if ( $atts['a']!='' ) $url2 .= '&a='. esc_attr( $atts['a'] );
		if ( $atts['css']!='' ) $url2 .= '&css='. esc_attr( $atts['css'] );  //check
		if ( $atts['rss']!='' ) $url2 .= '&rss='. esc_attr( $atts['rss'] );  //check
		if ( $atts['ln']!='' ) $url2 .= '&ln='. esc_attr( $atts['ln'] );
		if ( $atts['off']!='' ) $url2 .= '&off='. esc_attr( $atts['off'] );
		if ( $atts['su']!='' ) $url2 .= '&su='. esc_attr( $atts['su'] );
		if ( $atts['viewlink']!='' ) $url2 .= '&vl=1';
		if ( $atts['sb']!='' ) $url2 .= '&sb=1';
		
	/*
	sUrl += "&div=" + oLib.sDiv;
	
	if(oLib.Page!='') {sUrl += "&p=" + oLib.Page};
	if(oLib.ShowSummary!='') {sUrl += "&su=" + oLib.ShowSummary};
	if(oLib.ShowBack!='') {sUrl += "&sb=" + oLib.ShowBack};
	if(oLib.ShowExpand!='') {sUrl += "&se=" + oLib.ShowExpand};
	if(oLib.sPdf!=''){sUrl += "&Pdf=1"};
	if(oLib.sPrint!=''){sUrl += "&Prt=1"};
	if(oLib.UseSameDiv!='0') { sUrl += "&us=1" };
	if(oLib.UseTemplate!='') { sUrl += "&ut=1" };
	if(oLib.Target!='') { sUrl += "&tg=" + oLib.Target };
	if(oLib.Instance!='') { sUrl += "&in=" + oLib.Instance};
	if(oLib.ForceAtt!='') { sUrl += "&att=1"};
	
	if(oLib.InvID!='' && oLib.InvKey!='') {
		sUrl += "&i=" + oLib.InvID + "&ik=" + oLib.InvKey
	}

	*/
		//$contents = $url2 ;
		
		//$html .= ( $atts['server'] !== '' ) ? 'oLibView.sServer="' . esc_attr( $atts['server'] ) . '";' . "\n" : '';
		//$html = $url2 . "\n";
		//return $html;
		
		$contents = file_get_contents($url2);
		
		//If $contents is not a boolean FALSE value.
		if($contents !== false){
			if ( $atts['viewlink']!='' ) $contents = str_replace("=URL=",esc_attr( $atts['viewlink']),$contents);
			//Print out the contents.
			//return $contents;
		}
		
		
		if ( $atts['pd']=='0' ) $html .= '<a name="Lib' . esc_attr( $atts['group'] ) . '"></a><span id="DisplayListDiv1" style="display:none;"><a href="Javascript:document.location=\'#Lib65\'; getData();">Display list</a></span>' . "\n";
		if ( $atts['sdiv']!='' ) $libdivname = esc_attr( $atts['sdiv'] );
		$html .= '<div id="' . $libdivname . '" class="B2iPressContainer ' . $atts['class'] . '">' . $contents . '</div>' . "\n";
		return $html;
	}



	/**
	*********************************************************************************
	 * Define the Press Viewer plugin shortcode
	 * @since  0.9.6
	 * @return string
	*********************************************************************************
	 */
	public function press_view_shortcode( $atts ) {
		$html = '';
		$libdivname = $this->base_libviewdivname;
		$atts = shortcode_atts(
			array(
				'bizid' => '',
				'api' => '',
				'group' => '',
				'h' => 'https',
				'sdiv' => '',    // list div name, set when using multiple on same page
				'c' => '',     // count
				'd' => '',     // date - controls location
				'df' => '',    // dateformat
				'sb' => '',    // Show back
				'o' => '',     // output type div
				't' => '',     // tag id
				'f' => '',     // filter id
				'tl' => '',    // show tools - tags ddl and search box
				'ut' => '', 	//use template
				'css' => '',   // set to 0 to turn off default css
				'rss' => '',	//display rss button
				'class' => '',
				'server' => ''
			),
			$atts
		);
		
		
		$bizid = $this->business_id;
		$api = $this->key;
		if(esc_attr( $atts['bizid'])!='' && esc_attr( $atts['api'])!=''){
			$bizid = esc_attr( $atts['bizid']);
			$api = esc_attr( $atts['api']);
		}
		
		if ( $atts['group']!='' ) $libdivname .= esc_attr( $atts['group'] ) ;
		if ( $atts['sdiv']!='' ) $libdivname = esc_attr( $atts['sdiv'] );
		$html .= '<div id="' . $libdivname . '" class="b2iPressViewContainer ' . $atts['class'] . '"></div>' . "\n";
		$html .= '<script src="' . esc_url(esc_attr( $atts['h'] ) . $this->base_url2 . 'LibraryViewApi.asp?v=' . $this->version ) . '" type="text/javascript"></script>' . "\n";
		$html .= '<script type="text/javascript">' . "\n";
		$html .= 'oLibView.BizID="' . $bizid . '";' . "\n";
		$html .= 'oLibView.sKey="' . $api . '";' . "\n";
		$html .= 'oLibView.sDiv="' . $libdivname . '";' . "\n";
		if ( $atts['group']!='' ) $html .= 'oLibView.Group="' . esc_attr( $atts['group'] ) . '";' . "\n";
		if ( $atts['sb']!='' ) $html .= 'oLibView.ShowBack="1";' . "\n";
		$html .= ( $atts['h'] !== '' ) ? 'oLibView.sHttp="' . esc_attr( $atts['h'] ) . '";' . "\n" : '';
		$html .= ( $atts['c'] !== '' ) ? 'oLibView.Count="' . esc_attr( $atts['c'] ) . '";' . "\n" : '';
		$html .= ( $atts['d'] !== '' ) ? 'oLibView.ShowDate="' . esc_attr( $atts['d'] ) . '";' . "\n" : '';
		$html .= ( $atts['df'] !== '' ) ? 'oLibView.iDateFormat="' . esc_attr( $atts['df'] ) . '";' . "\n" : '';
		$html .= ( $atts['n'] !== '' ) ? 'oLibView.sNav="' . esc_attr( $atts['n'] ) . '";' . "\n" : '';
		$html .= ( $atts['o'] !== '' ) ? 'oLibView.Output="' . esc_attr( $atts['o'] ) . '";' . "\n" : '';
		$html .= ( $atts['t'] !== '' ) ? 'oLibView.Tag="' . esc_attr( $atts['t'] ) . '";' . "\n" : '';
		$html .= ( $atts['f'] !== '' ) ? 'oLibView.Filter="' . esc_attr( $atts['f'] ) . '";' . "\n" : '';
		$html .= ( $atts['tl'] !== '' ) ? 'oLibView.sTools="' . esc_attr( $atts['tl'] ) . '";' . "\n" : '';
		$html .= ( $atts['ut'] !== '' ) ? 'oLibView.UseTemplate="' . esc_attr( $atts['ut'] ) . '";' . "\n" : '';
		$html .= ( $atts['css'] !== '' ) ? 'oLibView.CSS="' . esc_attr( $atts['css'] ) . '";' . "\n" : '';
		$html .= ( $atts['rss'] !== '' ) ? 'oLibView.RSS="' . esc_attr( $atts['rss'] ) . '";' . "\n" : '';
		$html .= ( $atts['server'] !== '' ) ? 'oLibView.sServer="' . esc_attr( $atts['server'] ) . '";' . "\n" : '';
		$html .= 'getPRViewData();' . "\n";
		$html .= '</script>' . "\n";
		/*
		if ( $atts['pd']==0 ) $html .= '<span id="DisplayListDiv2" style="display:none;"><a href="Javascript:document.location=\'#Lib65\'; getData();">Display list</a></span>' . "\n"; 
		*/
		return $html;
	}



	/**
	*********************************************************************************
	 * Define the Press Viewer plugin shortcode - with Server side data pull
	 * @since  1.06
	 * @return string
	*********************************************************************************
	 */
	public function press_view_shortcode2( $atts ) {
		$html = '';
		$url2 = '';
		$libdivname = $this->base_libviewdivname;
		$atts = shortcode_atts(
			array(
				'group' => '',
				'h' => 'https',
				'bizid' => '',
				'api' => '',
				'sdiv' => '',    // list div name, set when using multiple on same page
				'c' => '',     // count
				'd' => '',     // date - controls location
				'df' => '',    // dateformat
				'sb' => '',    // Show back
				'o' => '',     // output type div
				't' => '',     // tag id
				'f' => '',     // filter id
				'tl' => '',    // show tools - tags ddl and search box
				'ut' => '', 	//use template
				'css' => '',   // set to 0 to turn off default css
				'rss' => '',	//display rss button
				'class' => '',
				'server' => ''
			),
			$atts
		);
		
		$bizid = $this->business_id;
		$api = $this->key;
		if(esc_attr( $atts['bizid'])!='' && esc_attr( $atts['api'])!=''){
			$bizid = esc_attr( $atts['bizid']);
			$api = esc_attr( $atts['api']);
		}
		
		$url2 = esc_attr( $atts['h'] ) . $this->base_url2 . 'LibraryView.asp?b=' . $bizid . '&api='. $api ;
		if(esc_attr( $atts['group'] )!='') $url2 .= '&g=' . esc_attr( $atts['group'] );
		if(isset($_REQUEST['i'])){
			if($_REQUEST['i']!='') $url2 .= '&id=' . $_REQUEST['i'];
		}
		if ( $atts['sb']!='' ) $url2 .= '&sb=1';
		if ( $atts['c']!='' ) $url2 .= '&c='. esc_attr( $atts['c'] );
		
			//if ( $atts['d']!='' ) $url2 .= '&c='. esc_attr( $atts['d'] );
			//if ( $atts['df']!='' ) $url2 .= '&c='. esc_attr( $atts['df'] );
			//if ( $atts['n']!='' ) $url2 .= '&c='. esc_attr( $atts['n'] );
			//if ( $atts['o']!='' ) $url2 .= '&c='. esc_attr( $atts['o'] );
			//if ( $atts['t']!='' ) $url2 .= '&c='. esc_attr( $atts['t'] );
			//if ( $atts['f']!='' ) $url2 .= '&c='. esc_attr( $atts['f'] );
			///if ( $atts['tl']!='' ) $url2 .= '&c='. esc_attr( $atts['tl'] );
			//if ( $atts['ut']!='' ) $url2 .= '&c='. esc_attr( $atts['ut'] );
			//if ( $atts['css']!='' ) $url2 .= '&c='. esc_attr( $atts['css'] );
			//if ( $atts['rss']!='' ) $url2 .= '&c='. esc_attr( $atts['rss'] );
			//$html .= ( $atts['server'] !== '' ) ? 'oLibView.sServer="' . esc_attr( $atts['server'] ) . '";' . "\n" : '';
			//$html = $url2 . "\n";
			//return $html;
		
		$contents = file_get_contents($url2);
		//If $contents is not a boolean FALSE value.
		if($contents !== false){
			//Print out the contents.
			//return $contents;
		}
		
		$libdivname .= esc_attr( $atts['group'] ) ;
		if ( $atts['sdiv']!='' ) $libdivname = esc_attr( $atts['sdiv'] );
		$html .= '<div id="' . $libdivname . '" class="B2iPressViewContainer ' . $atts['class'] . '">' . $contents . '</div>' . "\n";
		return $html;
	}



	/**
	*********************************************************************************
	 * Define the Custom Showcase plugin shortcode
	 * @since  0.1.0
	 * @return string
	*********************************************************************************
	 */
	public function showcase_shortcode( $atts ) {
		$html = '';
		$showdivname = $this->base_showdivname;
		$atts = shortcode_atts(
			array(
				'id' => '',
				'bizid' => '',
				'api' => '',
				'h' => 'https',
				'c' => '',
				'n' => '0',
				'a' => '0',
				'si' => '1',
				'tl' => '',
				'sd' => '1',
				'sh' => '0',
				'ds' => '1',
				'lo' => '',
				'y' => '',
				'l' => '1',
				'css' => '1',
				'isw' => '',
				'ish' => '',
				'ismw' => '',
				'ismh' => '',
				'ilo' => '',
				'ito' => '',
				'class' => '',
				'server' => ''
			),
			$atts
		);
		$showdivname .= esc_attr( $atts['id'] );
		$serverurl = $this->base_url2;
		
		$bizid = $this->business_id;
		$api = $this->key;
		
		if(esc_attr( $atts['bizid'])!='' && esc_attr( $atts['api'])!=''){
			$bizid = esc_attr( $atts['bizid']);
			$api = esc_attr( $atts['api']);
		}
		
		if(esc_attr( $atts['server'] )!='') $serverurl = '://' . esc_attr( $atts['server'] ) . '/b2i/';
		$html .= '<div id="' . $showdivname . '" class="b2iDocListContainer ' . $atts['class'] . '"></div>' . "\n";
		$html .= '<script src="' . esc_attr( $atts['h'] ) . $serverurl . 'Showapi.asp?v=' . $this->version . '&id=' . esc_attr( $atts['id'] ) . '" type="text/javascript"></script>' . "\n";
		$html .= '<script type="text/javascript">' . "\n";
		
		$html .= 'oShow'. esc_attr( $atts['id'] ) .'.BizID="' . $bizid . '";' . "\n";
		$html .= 'oShow'. esc_attr( $atts['id'] ) .'.sKey="' . $api . '";' . "\n";
		$html .= 'oShow'. esc_attr( $atts['id'] ) .'.ID="' . esc_attr( $atts['id'] ) . '";' . "\n";
		$html .= ( $atts['h'] !== '' ) ? 'oShow'. esc_attr( $atts['id'] ) .'.sHttp="' . esc_attr( $atts['h'] ) . '";' . "\n" : '';
		$html .= ( $atts['c'] !== '' ) ? 'oShow'. esc_attr( $atts['id'] ) .'.c="' . esc_attr( $atts['c'] ) . '";' . "\n" : '';
		$html .= ( $atts['a'] !== '0' ) ? 'oShow'. esc_attr( $atts['id'] ) .'.a="' . esc_attr( $atts['a'] ) . '";' . "\n" : '';
		$html .= ( $atts['n'] !== '' ) ? 'oShow'. esc_attr( $atts['id'] ) .'.n="' . esc_attr( $atts['n'] ) . '";' . "\n" : '';
		$html .= ( $atts['lo'] !== '' ) ? 'oShow'. esc_attr( $atts['id'] ) .'.lo="' . esc_attr( $atts['lo'] ) . '";' . "\n" : '';
		$html .= ( $atts['l'] !== '1' ) ? 'oShow'. esc_attr( $atts['id'] ) .'.lang="' . esc_attr( $atts['l'] ) . '";' . "\n" : '';
		$html .= ( $atts['y'] !== '' ) ? 'oShow'. esc_attr( $atts['id'] ) .'.Year="' . esc_attr( $atts['y'] ) . '";' . "\n" : '';
		$html .= ( $atts['si'] !== '' ) ? 'oShow'. esc_attr( $atts['id'] ) .'.si="' . esc_attr( $atts['si'] ) . '";' . "\n" : '';
		$html .= ( $atts['tl'] !== '' ) ? 'oShow'. esc_attr( $atts['id'] ) .'.sTools="' . esc_attr( $atts['tl'] ) . '";' . "\n" : '';
		$html .= ( $atts['sd'] !== '' ) ? 'oShow'. esc_attr( $atts['id'] ) .'.sd="' . esc_attr( $atts['sd'] ) . '";' . "\n" : '';
		$html .= ( $atts['sh'] !== '0' ) ? 'oShow'. esc_attr( $atts['id'] ) .'.sh="' . esc_attr( $atts['sh'] ) . '";' . "\n" : '';
		$html .= ( $atts['ds'] !== '1' ) ? 'oShow'. esc_attr( $atts['id'] ) .'.ds="' . esc_attr( $atts['ds'] ) . '";' . "\n" : '';
		$html .= ( $atts['css'] !== '1' ) ? 'oShow'. esc_attr( $atts['id'] ) .'.CSS="' . esc_attr( $atts['css'] ) . '";' . "\n" : '';
		$html .= ( $atts['isw'] !== '' ) ? 'oShow'. esc_attr( $atts['id'] ) .'.iStoryWidth="' . esc_attr( $atts['isw'] ) . '";' . "\n" : '';
		$html .= ( $atts['ish'] !== '' ) ? 'oShow'. esc_attr( $atts['id'] ) .'.iStoryHeight="' . esc_attr( $atts['ish'] ) . '";' . "\n" : '';
		$html .= ( $atts['ismw'] !== '' ) ? 'oShow'. esc_attr( $atts['id'] ) .'.iStoryMaxWidth="' . esc_attr( $atts['ismw'] ) . '";' . "\n" : '';
		$html .= ( $atts['ismh'] !== '' ) ? 'oShow'. esc_attr( $atts['id'] ) .'.iStoryMaxHeight="' . esc_attr( $atts['ismh'] ) . '";' . "\n" : '';
		$html .= ( $atts['ilo'] !== '' ) ? 'oShow'. esc_attr( $atts['id'] ) .'.iLeftOffset="' . esc_attr( $atts['ilo'] ) . '";' . "\n" : '';
		$html .= ( $atts['ito'] !== '' ) ? 'oShow'. esc_attr( $atts['id'] ) .'.iTopOffset="' . esc_attr( $atts['ito'] ) . '";' . "\n" : '';
		$html .= ( $atts['server'] !== '' ) ? 'oShow'. esc_attr( $atts['id'] ) .'.sServer="' . esc_attr( $atts['server'] ) . '";' . "\n" : '';
		$html .= 'getShowData();' . "\n";
		$html .= '</script>' . "\n";
		return $html;
	}
	
	
	
	/**
	*********************************************************************************
	 * Define the Dividends plugin shortcode
	 * @since  0.8.9
	 * @return string
	*********************************************************************************
	 */
	public function dividends_shortcode( $atts ) {
		$html = '';
		$atts = shortcode_atts(
			array(
				'bizid' => '',
				'api' => '',
				'sdiv' => '',
				's' => '',
				'css' => '1',
				'd' => '0',
				'dl' => '',
				'class' => '',
				'o' => '1'
			),
			$atts
		);
		
		$dividendsdivname = 'DividendsDiv';		
		if ( $atts['sdiv']!='' ) $dividendsdivname = esc_attr( $atts['sdiv'] );
		
		$bizid = $this->business_id;
		$api = $this->key;
		if(esc_attr( $atts['bizid'])!='' && esc_attr( $atts['api'])!=''){
			$bizid = esc_attr( $atts['bizid']);
			$api = esc_attr( $atts['api']);
		}
		
		$ticker = $this->ticker;
		if(esc_attr( $atts['s'])!=''){
			$ticker = esc_attr( $atts['s']);
		}
		
		$html .= '<div id="' . $dividendsdivname . '" class="B2iDividendContainer ' . $atts['class'] . '"></div>' . "\n";
		$html .= '<script src="https' . $this->base_url2 . 'DividendsApi.asp?v=' . $this->version . '" type="text/javascript"></script>' . "\n";
		$html .= '<script type="text/javascript">' . "\n";
		$html .= 'oDividends.BizID="' . $bizid . '";' . "\n";
		$html .= 'oDividends.sKey="' . $api . '";' . "\n";
		$html .= 'oDividends.sDiv="' . $dividendsdivname . '";' . "\n";
		$html .= 'oDividends.Symbol="' . $ticker . '";' . "\n";
		$html .= 'oDividends.css="' . esc_attr( $atts['css'] ) . '";' . "\n";
		$html .= ( $atts['d'] !== '0' ) ? 'oDividends.Dollar="' . esc_attr( $atts['d'] ) . '";' . "\n" : '';
		$html .= ( $atts['dl'] !== '' ) ? 'oDividends.DecLen="' . esc_attr( $atts['dl'] ) . '";' . "\n" : '';
		$html .= ( $atts['o'] !== '1' ) ? 'oDividends.o="' . esc_attr( $atts['o'] ) . '";' . "\n" : '';
		$html .= 'getDividendsData();' . "\n";
		$html .= '</script>' . "\n";
		return $html;
	}
	
	
	
	/**
	*********************************************************************************
	 * Define the Code plugin shortcode
	 * @since  0.8.1
	 * @return string
	*********************************************************************************
	 */
	public function code_shortcode( $atts ) {
		$html = '';
		$codedivname = $this->base_codedivname;
		$atts = shortcode_atts(
			array(
				'sdiv' => '',
				'bizid' => '',
				'api' => '',
				'id' => '1',
				'class' => '',
				'lo' => '1'
			),
			$atts
		);
		
		$bizid = $this->business_id;
		$api = $this->key;
		if(esc_attr( $atts['bizid'])!='' && esc_attr( $atts['api'])!=''){
			$bizid = esc_attr( $atts['bizid']);
			$api = esc_attr( $atts['api']);
		}
		
		$codedivname = 'CodeDiv' . esc_attr( $atts['id'] );		
		if ( $atts['sdiv']!='' ) $codedivname = esc_attr( $atts['sdiv'] );
		
		$html .= '<div id="' . $codedivname . '" class="B2iCodeContainer ' . $atts['class'] . '"></div>' . "\n";
		$html .= '<script src="https' . $this->base_url2 . 'CodeApi.asp?v=' . $this->version . '" type="text/javascript"></script>' . "\n";
		$html .= '<script type="text/javascript">' . "\n";
		$html .= 'oCode.BizID="' . $bizid . '";' . "\n";
		$html .= 'oCode.sKey="' . $api . '";' . "\n";
		$html .= 'oCode.sDiv="' . $codedivname . '";' . "\n";
		$html .= 'oCode.id="' . esc_attr( $atts['id'] ) . '";' . "\n";
		$html .= ( $atts['lo'] !== '1' ) ? 'oCode.lo="' . esc_attr( $atts['lo'] ) . '";' . "\n" : '';
		$html .= 'getCodeData();' . "\n";
		$html .= '</script>' . "\n";
		return $html;
	}
	
	
	
	/**
	*********************************************************************************
	 * Define the Page plugin shortcode
	 * @since  0.8.2
	 * @return string
	*********************************************************************************
	 */
	public function page_shortcode( $atts ) {
		$html = '';
		$codedivname = $this->base_codedivname;
		$atts = shortcode_atts(
			array(
				'sdiv' => '',
				'bizid' => '',
				'api' => '',
				'id' => '1',
				'sc' => '',
				'so' => '',
				'ih' => '',
				'lo' => '',
				'css' => '',
				'class' => '',
				'isw' => '',
				'ish' => '',
				'ismw' => '600',
				'ismh' => '600',
				'ilo' => '',
				'ito' => ''
			),
			$atts
		);
		
		$bizid = $this->business_id;
		$api = $this->key;
		if(esc_attr( $atts['bizid'])!='' && esc_attr( $atts['api'])!=''){
			$bizid = esc_attr( $atts['bizid']);
			$api = esc_attr( $atts['api']);
		}
		
		$pagedivname = 'PageDiv' . esc_attr( $atts['id'] );		
		if ( $atts['sdiv']!='' ) $pagedivname = esc_attr( $atts['sdiv'] );
		
		$html .= '<div id="' . $pagedivname . '" class="B2iMultiContainer ' . $atts['class'] . '"></div>' . "\n";
		$html .= '<script src="https' . $this->base_url2 . 'PageApi.js?v=' . $this->version . '" type="text/javascript"></script>' . "\n";
		$html .= '<script type="text/javascript">' . "\n";
		$html .= 'oPage.BizID="' . $bizid . '";' . "\n";
		$html .= 'oPage.sKey="' . $api . '";' . "\n";
		$html .= 'oPage.sDiv="' . $pagedivname . '";' . "\n";
		$html .= 'oPage.id="' . esc_attr( $atts['id'] ) . '";' . "\n";
		$html .= ( $atts['sc'] !== '' ) ? 'oPage.SectionCount="' . esc_attr( $atts['sc'] ) . '";' . "\n" : '';
		$html .= ( $atts['so'] !== '' ) ? 'oPage.SectionsOpen="' . esc_attr( $atts['so'] ) . '";' . "\n" : '';
		$html .= ( $atts['ih'] !== '' ) ? 'oPage.IgnoreHeaders="' . esc_attr( $atts['ih'] ) . '";' . "\n" : '';
		$html .= ( $atts['lo'] !== '' ) ? 'oPage.lo="' . esc_attr( $atts['lo'] ) . '";' . "\n" : '';
		$html .= ( $atts['css'] !== '' ) ? 'oPage.CSS="' . esc_attr( $atts['css'] ) . '";' . "\n" : '';
		$html .= ( $atts['isw'] !== '' ) ? 'oPage.iStoryWidth="' . esc_attr( $atts['isw'] ) . '";' . "\n" : '';
		$html .= ( $atts['ish'] !== '' ) ? 'oPage.iStoryHeight="' . esc_attr( $atts['ish'] ) . '";' . "\n" : '';
		$html .= ( $atts['ismw'] !== '' ) ? 'oPage.iStoryMaxWidth="' . esc_attr( $atts['ismw'] ) . '";' . "\n" : '';
		$html .= ( $atts['ismh'] !== '' ) ? 'oPage.iStoryMaxHeight="' . esc_attr( $atts['ismh'] ) . '";' . "\n" : '';
		$html .= ( $atts['ilo'] !== '' ) ? 'oPage.iLeftOffset="' . esc_attr( $atts['ilo'] ) . '";' . "\n" : '';
		$html .= ( $atts['ito'] !== '' ) ? 'oPage.iTopOffset="' . esc_attr( $atts['ito'] ) . '";' . "\n" : '';
		$html .= 'getPageData();' . "\n";
		$html .= '</script>' . "\n";
		return $html;
	}
	

	
	/**
	*********************************************************************************
	 * Define the Quote plugin shortcode
	 * @since  0.1.0
	 * @return string
	*********************************************************************************
	 */
	public function quote_shortcode( $atts ) {
		$html = '';
		$atts = shortcode_atts(
			array(
				'dataonly' => 'false',
				'sdiv' => 'qdiv',
				'h' => 'https',
				'f' => '1',
				'd' => '0',
				'dl' => '2',
				'o' => '',
				's' => ''
			),
			$atts
		);

		$endpoint = $atts['dataonly'] === 'true' ? 'quote3.asp' : 'QuotePlug.asp';
		
		$url_args = array(
			'b' => $this->business_id,
			'sdiv' => $atts['sdiv'],
			'h' => $atts['h'],
			'f' => $atts['f'],
			's' => $atts['s'],
			'd' => $atts['d'],
			'dl' => $atts['dl'],
			'o' => $atts['o']
		);
		
		$url = add_query_arg( $url_args, esc_attr( $atts['h'] ) . $this->base_url2 . $endpoint );
		if ($atts['dataonly'] == 'false') $html .= '<div id="qdiv"></div>' . "\n";
		$html .= '<script src="' . esc_url( $url ) . '" type="text/javascript"></script>' . "\n";
		return $html;
	}
	
	
	
	/**
	*********************************************************************************
	 * Define the stock plugin shortcode
	 * @since  0.6.8
	 * @return string
	*********************************************************************************
	 */
	public function stock_shortcode( $atts ) {
		$html = '';
		$stockdivname = $this->base_stockdivname;
		$atts = shortcode_atts(
			array(
				'bizid' => '',
				'api' => '',
				'sdiv' => '',
				'h' => 'https',
				'f' => '1',
				'd' => '1',
				'dl' => '2',
				's' => '',
				'e' => '',
				'ui' => '',
				'di' => '',
				'df' => '',
				'class' => '',
				'centsep' => '',
				'thoussep' => '',
				'css' => ''
			),
			$atts
		);
		
		$bizid = $this->business_id;
		$api = $this->key;
		
		if(esc_attr( $atts['bizid'])!='' && esc_attr( $atts['api'])!=''){
			$bizid = esc_attr( $atts['bizid']);
			$api = esc_attr( $atts['api']);
		}
		
		$ticker = $this->ticker;
		if(esc_attr( $atts['s'])!=''){
			$ticker = esc_attr( $atts['s']);
		}
		
		$stockdivname = 'QuoteDiv' . esc_attr( $atts['f'] );		
		if ( $atts['sdiv']!='' ) $stockdivname = esc_attr( $atts['sdiv'] );
		
		$html .= '<div id="' . $stockdivname . '" class="B2iQuoteContainer ' . $atts['class'] . '"></div>' . "\n";
		$html .= '<script src="' . esc_url( esc_attr( $atts['h'] ) . $this->base_url2 . 'QuoteApi.asp?v=' . $this->version ) . '" type="text/javascript"></script>' . "\n";
		$html .= '<script type="text/javascript">' . "\n";
		$html .= 'oQuote.BizID="' . $bizid. '";' . "\n";
		$html .= 'oQuote.sKey="' . $api . '";' . "\n";
		//$html .= 'oQuote.BizID="' . $this->business_id . '";' . "\n";
		//$html .= 'oQuote.sKey="' . $this->key . '";' . "\n";
		$html .= 'oQuote.sDiv="' . $stockdivname . '";' . "\n";
		$html .= 'oQuote.Symbol="' . $ticker . '";' . "\n";
		$html .= ( $atts['h'] !== '' ) ? 'oQuote.sHttp="' . esc_attr( $atts['h'] ) . '";' . "\n" : '';
		$html .= ( $atts['f'] !== '' ) ? 'oQuote.Format="' . esc_attr( $atts['f'] ) . '";' . "\n" : '';
		$html .= ( $atts['d'] !== '' ) ? 'oQuote.Dollar="' . esc_attr( $atts['d'] ) . '";' . "\n" : '';
		$html .= ( $atts['dl'] !== '' ) ? 'oQuote.DecLen="' . esc_attr( $atts['dl'] ) . '";' . "\n" : '';
		$html .= ( $atts['e'] !== '' ) ? 'oQuote.Exchange="' . esc_attr( $atts['e'] ) . '";' . "\n" : '';
		$html .= ( $atts['ui'] !== '' ) ? 'oQuote.Upimage="' . esc_attr( $atts['ui'] ) . '";' . "\n" : '';
		$html .= ( $atts['di'] !== '' ) ? 'oQuote.Downimage="' . esc_attr( $atts['di'] ) . '";' . "\n" : '';
		$html .= ( $atts['centsep'] !== '' ) ? 'oQuote.Centseperator="' . esc_attr( $atts['centsep'] ) . '";' . "\n" : '';
		$html .= ( $atts['thoussep'] !== '' ) ? 'oQuote.Numseperator="' . esc_attr( $atts['thoussep'] ) . '";' . "\n" : '';
		$html .= ( $atts['df'] !== '' ) ? 'oQuote.DateFormat="' . esc_attr( $atts['df'] ) . '";' . "\n" : '';
		$html .= ( $atts['css'] !== '' ) ? 'oQuote.CSS="' . esc_attr( $atts['css'] ) . '";' . "\n" : '';
		$html .= 'getQuoteData();' . "\n";
		$html .= '</script>' . "\n";
		
		return $html;
	}
	
	
	
	/**
	*********************************************************************************
	 * Define the stock plugin shortcode
	 * @since  0.6.9
	 * @return string
	*********************************************************************************
	 */
	public function HistoricalQuote_shortcode( $atts ) {
		$html = '';
		$atts = shortcode_atts(
			array(
				'bizid' => '',
				'api' => '',
				'sdiv' => '',
				's' => '',
				'h' => 'https',
				'd' => '1',
				'dl' => '2',
				'css' => '',
				'lo' => '1',
				'lang' => '1',
				'df' => '',
				'centsep' => '.',
				'thoussep' => ',',
				'class' => '',
				'se' => ''
			),
			$atts
		);
		
		$bizid = $this->business_id;
		$api = $this->key;
		
		if(esc_attr( $atts['bizid'])!='' && esc_attr( $atts['api'])!=''){
			$bizid = esc_attr( $atts['bizid']);
			$api = esc_attr( $atts['api']);
		}
		
		$ticker = $this->ticker;
		if(esc_attr( $atts['s'])!=''){
			$ticker = esc_attr( $atts['s']);
		}
		
		$historicldivname = 'HistoricalDiv';		
		if ( $atts['sdiv']!='' ) $historicldivname = esc_attr( $atts['sdiv'] );
		
		$html .= '<div id="' . $historicldivname . '" class="B2iHistoricalContainer ' . $atts['class'] . '"></div>' . "\n";
		$html .= '<script src="' . esc_url( esc_attr( $atts['h'] ) . $this->base_url2 . 'HistoricalQuoteApi.asp?v=' . $this->version ) . '" type="text/javascript"></script>' . "\n";
		$html .= '<script type="text/javascript">' . "\n";
		$html .= 'oHistoric.BizID="' . $bizid . '";' . "\n";
		$html .= 'oHistoric.sKey="' . $api . '";' . "\n";
		$html .= 'oHistoric.Symbol="' . $ticker . '";' . "\n";
		$html .= ( $atts['h'] !== '' ) ? 'oHistoric.sHttp="' . esc_attr( $atts['h'] ) . '";' . "\n" : '';
		$html .= ( $atts['sdiv'] !== '' ) ? 'oHistoric.sDiv="' . esc_attr( $atts['sdiv'] ) . '";' . "\n" : '';
		$html .= ( $atts['d'] !== '' ) ? 'oHistoric.Dollar="' . esc_attr( $atts['d'] ) . '";' . "\n" : '';
		$html .= ( $atts['dl'] !== '' ) ? 'oHistoric.DecLen="' . esc_attr( $atts['dl'] ) . '";' . "\n" : '';
		$html .= ( $atts['css'] !== '' ) ? 'oHistoric.CSS="' . esc_attr( $atts['css'] ) . '";' . "\n" : '';
		$html .= ( $atts['se'] !== '' ) ? 'oHistoric.ShowExport="' . esc_attr( $atts['se'] ) . '";' . "\n" : '';
		$html .= ( $atts['df'] !== '' ) ? 'oHistoric.DateFormat="' . esc_attr( $atts['df'] ) . '";' . "\n" : '';
		$html .= ( $atts['lo'] !== '1' ) ? 'oHistoric.lo="' . esc_attr( $atts['lo'] ) . '";' . "\n" : '';
		$html .= ( $atts['lang'] !== '1' ) ? 'oHistoric.Lang="' . esc_attr( $atts['lang'] ) . '";' . "\n" : '';
		$html .= ( $atts['centsep'] !== '' ) ? 'oHistoric.Centseperator="' . esc_attr( $atts['centsep'] ) . '";' . "\n" : '';
		$html .= ( $atts['thoussep'] !== '' ) ? 'oHistoric.Numseperator="' . esc_attr( $atts['thoussep'] ) . '";' . "\n" : '';
		$html .= 'getHistoricalData();' . "\n";
		$html .= '</script>' . "\n";
		return $html;
	}
	
	
	
	/**
	*********************************************************************************
	 * Define the Committee plugin shortcode
	 * @since  0.6.3
	 * @return string
	*********************************************************************************
	 */
	public function comm_shortcode( $atts ) {
		$html = '';
		$atts = shortcode_atts(
			array(
				'sdiv' => '',
				'bizid' => '',
				'api' => '',
				'h' => 'https',
				'lo' => '',
				'class' => '',
				'vl' => ''
			),
			$atts
		);
		
		$bizid = $this->business_id;
		$api = $this->key;
		if(esc_attr( $atts['bizid'])!='' && esc_attr( $atts['api'])!=''){
			$bizid = esc_attr( $atts['bizid']);
			$api = esc_attr( $atts['api']);
		}
		
		$commdivname = 'CommDiv';		
		if ( $atts['sdiv']!='' ) $commdivname = esc_attr( $atts['sdiv'] );
		
		$html .= '<div id="' . $commdivname . '" class="B2iCommitteeContainer ' . $atts['class'] . '"></div>' . "\n";
		$html .= '<script src="' . esc_url( esc_attr( $atts['h'] ) . $this->base_url2 . 'Commapi.asp?v=' . $this->version ) . '" type="text/javascript"></script>' . "\n";
		$html .= '<script type="text/javascript">' . "\n";
		$html .= 'oComm.BizID="' . $bizid . '";' . "\n";
		$html .= 'oComm.sKey="' . $api . '";' . "\n";
		$html .= ( $atts['h'] !== '' ) ? 'oComm.sHttp="' . esc_attr( $atts['h'] ) . '";' . "\n" : '';
		$html .= ( $atts['lo'] !== '' ) ? 'oComm.lo="' . esc_attr( $atts['lo'] ) . '";' . "\n" : '';
		$html .= ( $atts['vl'] !== '' ) ? 'oComm.Viewlink="' . esc_attr( $atts['vl'] ) . '";' . "\n" : '';
		$html .= 'getCommData();' . "\n";
		$html .= '</script>' . "\n";
		return $html;
	}

	
	
	/**
	*********************************************************************************
	 * Define the Director plugin shortcode
	 * @since  0.6.4
	 * @return string
	*********************************************************************************
	 */
	public function directors_shortcode( $atts ) {
		$html = '';
		$atts = shortcode_atts(
			array(
				'sdiv' => '',
				'bizid' => '',
				'api' => '',
				'h' => 'https',
				'lo' => '0',
				'vl' => '',
				'vlp' => '',
				'class' => '',
				'group' => '',
				'so' => ''
			),
			$atts
		);
		
		$bizid = $this->business_id;
		$api = $this->key;
		if(esc_attr( $atts['bizid'])!='' && esc_attr( $atts['api'])!=''){
			$bizid = esc_attr( $atts['bizid']);
			$api = esc_attr( $atts['api']);
		}
		
		$DirUrl = esc_attr( $atts['h'] ) . $this->base_url2 . 'DirectorApi.asp?';
		if($atts['lo']!="0"){ $DirUrl .= 'lo=' . $atts['lo'] . '&'; }
		$DirUrl .= 'v=' . $this->version;
		$dirdivname = "DirDiv";
		if ( $atts['sdiv']!='' ) $dirdivname = esc_attr( $atts['sdiv'] );
		$html .= '<div id="' . $dirdivname . '" class="B2iDirectorsContainer ' . $atts['class'] . '"></div>' . "\n";
		$html .= '<script src="' . $DirUrl . '" type="text/javascript"></script>' . "\n";
		$html .= '<script type="text/javascript">' . "\n";
		$html .= 'oDir.BizID="' . $bizid . '";' . "\n";
		$html .= 'oDir.sKey="' . $api . '";' . "\n";
		if ( $atts['sdiv']!='' ) $html .= 'oDir.sDiv="' . esc_attr( $atts['sdiv'] ) . '";' . "\n";
		$html .= ( $atts['lo'] !== '' ) ? 'oDir.lo="' . esc_attr( $atts['lo'] ) . '";' . "\n" : '';
		$html .= ( $atts['vl'] !== '' ) ? 'oDir.ViewLink="' . esc_attr( $atts['vl'] ) . '";' . "\n" : '';
		if ( $atts['vlp']!='' ) $html .= 'oDir.vlp="' . esc_attr( $atts['vlp'] ) . '";' . "\n";
		$html .= ( $atts['so'] !== '' ) ? 'oDir.sOpen="' . esc_attr( $atts['so'] ) . '";' . "\n" : '';
		if ( $atts['group']!='' ) $html .= 'oDir.Group="' . esc_attr( $atts['group'] ) . '";' . "\n";
		$html .= 'getDirData();' . "\n";
		$html .= '</script>' . "\n";
		return $html;
	}


	
	/**
	*********************************************************************************
	 * Define the Director Viewer plugin shortcode
	 * @since  1.0.5
	 * @return string
	*********************************************************************************
	 */
	public function directors_view_shortcode( $atts ) {
		$html = '';
		$atts = shortcode_atts(
			array(
				'sdiv' => '',
				'bizid' => '',
				'api' => '',
				'h' => 'https',
				'class' => '',
				'lo' => '1'
			),
			$atts
		);

		$bizid = $this->business_id;
		$api = $this->key;
		if(esc_attr( $atts['bizid'])!='' && esc_attr( $atts['api'])!=''){
			$bizid = esc_attr( $atts['bizid']);
			$api = esc_attr( $atts['api']);
		}
		
		$DirViewUrl = esc_attr( $atts['h'] ) . $this->base_url2 . 'DirectorViewApi.asp?';
		if($atts['lo']!="0"){ $DirViewUrl .= 'lo=' . $atts['lo'] . '&'; }
		$DirViewUrl .= 'v=' . $this->version;
		$dirdivname = "DirViewDiv";
		if ( $atts['sdiv']!='' ) $dirdivname = esc_attr( $atts['sdiv'] );
		$html .= '<div id="' . $dirdivname . '" class="B2iDirectorViewContainer ' . $atts['class'] . '"></div>' . "\n";
		$html .= '<script src="' . $DirViewUrl . '" type="text/javascript"></script>' . "\n";
		$html .= '<script type="text/javascript">' . "\n";
		$html .= 'oDirView.BizID="' . $this->business_id . '";' . "\n";
		$html .= 'oDirView.sKey="' . $this->key . '";' . "\n";
		$html .= ( $atts['lo'] !== '' ) ? 'oDirView.lo="' . esc_attr( $atts['lo'] ) . '";' . "\n" : '';
		$html .= 'getDirViewData();' . "\n";
		$html .= '</script>' . "\n";
		return $html;
	}
	

	
	/**
	*********************************************************************************
	 * Define the Management plugin shortcode
	 * @since  0.6.4
	 * @return string
	*********************************************************************************
	 */
	public function management_shortcode( $atts ) {
		$html = '';
		$atts = shortcode_atts(
			array(
				'sdiv' => '',
				'h' => 'https',
				'lo' => '0',
				'vl' => '',
				'class' => '',
				'so' => ''
			),
			$atts
		);
		$url_args=array();
		$url = add_query_arg( $url_args, esc_attr( $atts['h'] ) . $this->base_url2 );
		
		$MgtUrl = esc_attr( $atts['h'] ) . $this->base_url2 . 'MgmtApi.asp?';
		if($atts['lo']!="0"){
			$MgtUrl .= 'lo=' . $atts['lo'] . '&';
		}
		$MgtUrl .= 'v=' . $this->version;
		
		$mgmtdivname = "MgmtDiv";
		if ( $atts['sdiv']!='' ) $mgmtdivname = esc_attr( $atts['sdiv'] );
		$html .= '<div id="' . $mgmtdivname . '" class="B2iManagementContainer ' . $atts['class'] . '"></div>' . "\n";
		$html .= '<script src="' . $MgtUrl . '" type="text/javascript"></script>' . "\n";
		$html .= '<script type="text/javascript">' . "\n";
		$html .= 'oMgmt.BizID="' . $this->business_id . '";' . "\n";
		$html .= 'oMgmt.sKey="' . $this->key . '";' . "\n";
		$html .= ( $atts['lo'] !== '' ) ? 'oMgmt.lo="' . esc_attr( $atts['lo'] ) . '";' . "\n" : '';
		$html .= ( $atts['vl'] !== '' ) ? 'oMgmt.ViewLink="' . esc_attr( $atts['vl'] ) . '";' . "\n" : '';
		$html .= ( $atts['so'] !== '' ) ? 'oMgmt.sOpen="' . esc_attr( $atts['so'] ) . '";' . "\n" : '';
		$html .= 'getMgmtData();' . "\n";
		$html .= '</script>' . "\n";
		return $html;
	}

	
	
	/**
	*********************************************************************************
	 * Define the Management plugin shortcode
	 * @since  1.0.5
	 * @return string
	*********************************************************************************
	 */
	public function management_view_shortcode( $atts ) {
		$html = '';
		$atts = shortcode_atts(
			array(
				'bizid' => '',
				'api' => '',
				'sdiv' => '',
				'h' => 'https',
				'class' => '',
				'lo' => '1'
			),
			$atts
		);
		
		$url_args=array();
		$url = add_query_arg( $url_args, esc_attr( $atts['h'] ) . $this->base_url2 );
		
		$MgtViewUrl = esc_attr( $atts['h'] ) . $this->base_url2 . 'MgtViewApi.asp?';
		if($atts['lo']!="0"){
			$MgtViewUrl .= 'lo=' . $atts['lo'] . '&';
		}
		$MgtViewUrl .= 'v=' . $this->version;
		
		$bizid = $this->business_id;
		$api = $this->key;
		if(esc_attr( $atts['bizid'])!='' && esc_attr( $atts['api'])!=''){
			$bizid = esc_attr( $atts['bizid']);
			$api = esc_attr( $atts['api']);
		}
		
		$mgmtdivname = "MgtViewDiv";
		if ( $atts['sdiv']!='' ) $mgmtdivname = esc_attr( $atts['sdiv'] );
		$html .= '<div id="' . $mgmtdivname . '" class="B2iManagementViewContainer ' . $atts['class'] . '"></div>' . "\n";
		$html .= '<script src="' . $MgtViewUrl . '" type="text/javascript"></script>' . "\n";
		$html .= '<script type="text/javascript">' . "\n";
		$html .= 'oMgtView.BizID="' . $bizid . '";' . "\n";
		$html .= 'oMgtView.sKey="' . $api . '";' . "\n";
		$html .= ( $atts['lo'] !== '' ) ? 'oMgtView.lo="' . esc_attr( $atts['lo'] ) . '";' . "\n" : '';
		$html .= 'getMgtViewData();' . "\n";
		$html .= '</script>' . "\n";
		return $html;
	}

	
	
	/**
	*********************************************************************************
	 * Define the Analyst plugin shortcode
	 * @since  0.8.1
	 * @return string
	*********************************************************************************
	 */
	public function analyst_shortcode( $atts ) {
		$html = '';
		$atts = shortcode_atts(
			array(
				'bizid' => '',
				'api' => '',
				'sdiv' => '',
				'css' => '1',
				'lo' => '1',
				'class' => '',
				'o' => '1'
			),
			$atts
		);
		
		$bizid = $this->business_id;
		$api = $this->key;
		if(esc_attr( $atts['bizid'])!='' && esc_attr( $atts['api'])!=''){
			$bizid = esc_attr( $atts['bizid']);
			$api = esc_attr( $atts['api']);
		}
		
		$analystdivname = 'AnalystDiv';		
		if ( $atts['sdiv']!='' ) $analystdivname = esc_attr( $atts['sdiv'] );
		
		$html .= '<div id="' . $analystdivname . '" class="B2iAnalystContainer ' . $atts['class'] . '"></div>' . "\n";
		$html .= '<script src="https' . $this->base_url2 . 'AnalystApi.asp?v=' . $this->version . '" type="text/javascript"></script>' . "\n";
		$html .= '<script type="text/javascript">' . "\n";
		$html .= 'oAnalyst.BizID="' . $bizid . '";' . "\n";
		$html .= 'oAnalyst.sKey="' . $api . '";' . "\n";
		$html .= 'oAnalyst.sDiv="' . $analystdivname . '";' . "\n";
		$html .= 'oAnalyst.css="' . esc_attr( $atts['css'] ) . '";' . "\n";
		$html .= ( $atts['o'] !== '1' ) ? 'oAnalyst.o="' . esc_attr( $atts['o'] ) . '";' . "\n" : '';
		$html .= ( $atts['lo'] !== '1' ) ? 'oAnalyst.lo="' . esc_attr( $atts['lo'] ) . '";' . "\n" : '';
		$html .= 'getAnalystData();' . "\n";
		$html .= '</script>' . "\n";
		return $html;
	}
	
	
	
	/**
	*********************************************************************************
	 * Define the Event Calendar plugin shortcode
	 * @since  0.6.6
	 * @return string
	*********************************************************************************
	 */
	public function cal_shortcode( $atts ) {
		$html = '';
		$atts = shortcode_atts(
			array(
				'bizid' => '',
				'api' => '',
				'sdiv' => '',
				'h' => 'https',
				'g' => '',
				'c' => '',
				'y' => '',
				'tl' => '',
				'se' => '',
				'm' => '',
				'df' => '0',
				'dlo' => '0',
				'lo' => '',
				'vl' => '',
				'css' => '',
				'class' => '',
				'a' => ''
			),
			$atts
		);
		
		$bizid = $this->business_id;
		$api = $this->key;
		if(esc_attr( $atts['bizid'])!='' && esc_attr( $atts['api'])!=''){
			$bizid = esc_attr( $atts['bizid']);
			$api = esc_attr( $atts['api']);
		}
		
		$caldivname = 'CalDiv' . esc_attr( $atts['m'] ) . esc_attr( $atts['y'] );
		if ( $atts['g']!='' ) $caldivname = $caldivname . esc_attr( $atts['g'] );
		if ( $atts['sdiv']!='' )  $caldivname = esc_attr( $atts['sdiv'] );
		
		$html .= '<div id="' . $caldivname . '" class="B2iCalendarContainer ' . $atts['class'] . '"></div>' . "\n";
		$html .= '<script src="' . esc_url( esc_attr( $atts['h'] ) . $this->base_url2 . 'Calapi.asp?v=' . $this->version ) . '" type="text/javascript"></script>' . "\n";
		$html .= '<script type="text/javascript">' . "\n";
		$html .= 'oCal.BizID="' . $bizid . '";' . "\n";
		$html .= 'oCal.sKey="' . $api . '";' . "\n";
		$html .= 'oCal.sDiv="' . $caldivname . '";' . "\n";
		$html .= ( $atts['g'] !== '' ) ? 'oCal.Group="' . esc_attr( $atts['g'] ) . '";' . "\n" : '';
		$html .= ( $atts['h'] !== '' ) ? 'oCal.sHttp="' . esc_attr( $atts['h'] ) . '";' . "\n" : '';
		$html .= ( $atts['c'] !== '' ) ? 'oCal.Count="' . esc_attr( $atts['c'] ) . '";' . "\n" : '';
		$html .= ( $atts['y'] !== '' ) ? 'oCal.Year="' . esc_attr( $atts['y'] ) . '";' . "\n" : '';
		$html .= ( $atts['m'] !== '' ) ? 'oCal.Mode="' . esc_attr( $atts['m'] ) . '";' . "\n" : '';
		$html .= ( $atts['tl'] !== '' ) ? 'oCal.tl="' . esc_attr( $atts['tl'] ) . '";' . "\n" : '';
		$html .= ( $atts['vl'] !== '' ) ? 'oCal.ViewLink="' . esc_attr( $atts['vl'] ) . '";' . "\n" : '';
		$html .= ( $atts['df'] !== '' ) ? 'oCal.iDateFormat="' . esc_attr( $atts['df'] ) . '";' . "\n" : '';
		$html .= ( $atts['dlo'] !== '' ) ? 'oCal.iDateLocation="' . esc_attr( $atts['dlo'] ) . '";' . "\n" : '';
		$html .= ( $atts['lo'] !== '' ) ? 'oCal.lo="' . esc_attr( $atts['lo'] ) . '";' . "\n" : '';
		$html .= ( $atts['css'] !== '' ) ? 'oCal.CSS="' . esc_attr( $atts['css'] ) . '";' . "\n" : '';
		$html .= 'getCalData();' . "\n";
		$html .= '</script>' . "\n";
		return $html;
	}

	
	
	/**
	*********************************************************************************
	 * Define the Event Viewer plugin shortcode
	 * @since  1.0.5
	 * @return string
	*********************************************************************************
	 */
	public function cal_view_shortcode( $atts ) {
		$html = '';
		$atts = shortcode_atts(
			array(
				'bizid' => '',
				'api' => '',
				'sdiv' => '',
				'h' => 'https',
				'g' => '',
				'c' => '',
				'y' => '',
				'tl' => '',
				'm' => '',
				'df' => '0',
				'dlo' => '0',
				'lo' => '',
				'class' => '',
				'a' => ''
			),
			$atts
		);
		
		$bizid = $this->business_id;
		$api = $this->key;
		if(esc_attr( $atts['bizid'])!='' && esc_attr( $atts['api'])!=''){
			$bizid = esc_attr( $atts['bizid']);
			$api = esc_attr( $atts['api']);
		}
		
		$calviewdivname = 'CalViewDiv' . esc_attr( $atts['m'] ) . esc_attr( $atts['y'] );
		if ( $atts['g']!='' ) $calviewdivname = $calviewdivname . esc_attr( $atts['g'] );
		if ( $atts['sdiv']!='' )  $calviewdivname = esc_attr( $atts['sdiv'] );
		
		$html .= '<div id="' . $calviewdivname . '" class="B2iCalendarViewContainer ' . $atts['class'] . '"></div>' . "\n";
		$html .= '<script src="' . esc_url( esc_attr( $atts['h'] ) . $this->base_url2 . 'CalViewapi.asp?v=' . $this->version ) . '" type="text/javascript"></script>' . "\n";
		$html .= '<script type="text/javascript">' . "\n";
		$html .= 'oCalView.BizID="' . $bizid . '";' . "\n";
		$html .= 'oCalView.sKey="' . $api . '";' . "\n";
		$html .= 'oCalView.sDiv="' . $calviewdivname . '";' . "\n";
		$html .= ( $atts['g'] !== '' ) ? 'oCalView.Group="' . esc_attr( $atts['g'] ) . '";' . "\n" : '';
		$html .= ( $atts['h'] !== '' ) ? 'oCalView.sHttp="' . esc_attr( $atts['h'] ) . '";' . "\n" : '';
		$html .= ( $atts['c'] !== '' ) ? 'oCalView.Count="' . esc_attr( $atts['c'] ) . '";' . "\n" : '';
		$html .= ( $atts['y'] !== '' ) ? 'oCalView.Year="' . esc_attr( $atts['y'] ) . '";' . "\n" : '';
		$html .= ( $atts['m'] !== '' ) ? 'oCalView.Mode="' . esc_attr( $atts['m'] ) . '";' . "\n" : '';
		$html .= ( $atts['tl'] !== '' ) ? 'oCalView.tl="' . esc_attr( $atts['tl'] ) . '";' . "\n" : '';
		$html .= ( $atts['df'] !== '' ) ? 'oCalView.iDateFormat="' . esc_attr( $atts['df'] ) . '";' . "\n" : '';
		$html .= ( $atts['dlo'] !== '' ) ? 'oCalView.iDateLocation="' . esc_attr( $atts['dlo'] ) . '";' . "\n" : '';
		$html .= ( $atts['lo'] !== '' ) ? 'oCalView.lo="' . esc_attr( $atts['lo'] ) . '";' . "\n" : '';
		$html .= 'getCalViewData();' . "\n";
		$html .= '</script>' . "\n";
		return $html;
	}
	
	
		
	/**
	*********************************************************************************
	 * Define the Financials plugin shortcode
	 * @since  0.6.7
	 * @return string
	*********************************************************************************
	 */
	public function financials_shortcode( $atts ) {
		$findivname = $this->base_findivname;
		$html = '';
		$atts = shortcode_atts(
			array(
				'bizid' => '',
				'api' => '',
				's' => '',
				'm' => '',
				'd' => '',
				'dn' => '',
				'class' => '',
				'c' => '',
				'h' => 'https'
			),
			$atts
		);
		
		$bizid = $this->business_id;
		$api = $this->key;
		if(esc_attr( $atts['bizid'])!='' && esc_attr( $atts['api'])!=''){
			$bizid = esc_attr( $atts['bizid']);
			$api = esc_attr( $atts['api']);
		}
		
		
		$ticker = $this->ticker;
		if(esc_attr( $atts['s'])!=''){
			$ticker = esc_attr( $atts['s']);
		}
		
		$findivname="Financials";
		switch ($atts['m']) {
			case '1':
				$findivname='Cash';
				break;
			case '2':
				$findivname='Income';
				break;
			case '3':
				$findivname='Balance';
				break;
		}
		
		$html .= '<div id="' . $findivname . '" class="B2iFinancialsContainer ' . $atts['class'] . '"></div>' . "\n";
		$html .= '<script src="' . esc_url( esc_attr( $atts['h'] ) . $this->base_url2 . 'FundamentalApi.asp?v=' . $this->version ) . '" type="text/javascript"></script>' . "\n";
		$html .= '<script type="text/javascript">' . "\n";
		$html .= 'oFinancials.BizID="' . $bizid . '";' . "\n";
		$html .= 'oFinancials.sKey="' . $api . '";' . "\n";
		$html .= 'oFinancials.Symbol="' . $ticker . '";' . "\n";
		$html .= ( $atts['h'] !== '' ) ? 'oFinancials.sHttp="' . esc_attr( $atts['h'] ) . '";' . "\n" : '';
		$html .= ( $atts['m'] !== '' ) ? 'oFinancials.Mode="' . esc_attr( $atts['m'] ) . '";' . "\n" : '';
		$html .= ( $atts['d'] !== '' ) ? 'oFinancials.Dollar="' . esc_attr( $atts['d'] ) . '";' . "\n" : '';
		$html .= ( $atts['c'] !== '' ) ? 'oFinancials.Count=' . esc_attr( $atts['c'] ) . ';' . "\n" : '';
		$html .= 'oFinancials.sDiv="' . $findivname . '";' . "\n";
		$html .= 'getFinancialsData();' . "\n";
		$html .= '</script>' . "\n";
		return $html;
	}

			
	
	/**
	*********************************************************************************
	 * Define the Institutional Holdings plugin shortcode
	 * @since  0.6.6
	 * @return string
	*********************************************************************************
	 */
	public function institutional_shortcode( $atts ) {
		$html = '';
		$atts = shortcode_atts(
			array(
				'h' => 'https',
				's' => '',
				'c' => ''
			),
			$atts
		);

		$url_args = array(
			'h' => $atts['h'],
			's' => $atts['s'],
			'c' => $atts['c']
		);

		$ticker = $this->ticker;
		if(esc_attr( $atts['s'])!=''){
			$ticker = esc_attr( $atts['s']);
		}
		
		$html .= '<div id="InstiDiv"></div>' . "\n";
		$html .= '<script src="' . esc_url( esc_attr( $atts['h'] ) . $this->base_url2 . 'InstitutionalAPI.asp?v=' . $this->version ) . '" type="text/javascript"></script>' . "\n";
		$html .= '<script type="text/javascript">' . "\n";
		$html .= 'oInsti.BizID="' . $this->business_id . '";' . "\n";
		$html .= 'oInsti.sKey="' . $this->key . '";' . "\n";
		$html .= 'oInsti.Symbol="' . $ticker . '";' . "\n";
		$html .= ( $atts['h'] !== '' ) ? 'oInsti.sHttp="' . esc_attr( $atts['h'] ) . '";' . "\n" : '';
		$html .= ( $atts['c'] !== '' ) ? 'oInsti.Count=' . esc_attr( $atts['c'] ) . ';' . "\n" : '';
		$html .= 'getInstiData();' . "\n";
		$html .= '</script>' . "\n";
		return $html;
	}


	
	/**
	*********************************************************************************
	 * Define the Insider Holdings plugin shortcode
	 * @since  0.6.6
	 * @return string
	*********************************************************************************
	 */
	public function insiders_shortcode( $atts ) {
		$html = '';
		$atts = shortcode_atts(
			array(
				'h' => 'https',
				's' => '',
				'c' => ''
			),
			$atts
		);
		
		$bizid = $this->business_id;
		if(esc_attr( $atts['bizid'])!=''){
			$bizid = esc_attr( $atts['bizid']);
		}

		$api = $this->key;
		if(esc_attr( $atts['api'])!=''){
			$api = esc_attr( $atts['api']);
		}
		$ticker = $this->ticker;
		if(esc_attr( $atts['s'])!=''){
			$ticker = esc_attr( $atts['s']);
		}

		$html .= '<div id="InsidersDiv"></div>' . "\n";
		$html .= '<script src="' . esc_url( esc_attr( $atts['h'] ) . $this->base_url2 . 'InsidersApi.asp?v=' . $this->version ) . '" type="text/javascript"></script>' . "\n";
		$html .= '<script type="text/javascript">' . "\n";
		$html .= 'oInsiders.BizID="' . $bizid . '";' . "\n";
		$html .= 'oInsiders.sKey="' . $api . '";' . "\n";
		$html .= 'oInsiders.Symbol="' . $ticker . '";' . "\n";
		$html .= ( $atts['h'] !== '' ) ? 'oInsiders.sHttp="' . esc_attr( $atts['h'] ) . '";' . "\n" : '';
		$html .= ( $atts['c'] !== '' ) ? 'oInsiders.Count=' . esc_attr( $atts['c'] ) . ';' . "\n" : '';
		$html .= 'getInsidersData();' . "\n";
		$html .= '</script>' . "\n";
		return $html;
	}

	
	
	/**
	*********************************************************************************
	 * Define the Library single plugin shortcode
	 * @since  0.1.0
	 * @return string
	*********************************************************************************
	 */
	public function library_latest_item_shortcode( $atts ) {
		$atts = shortcode_atts(
			array(
				'g' => '',
				't' => '',
				'f' => '',
				'i' => '5',
				'off' => '',
				'out' => '',
				'ln' => '',
				'n' => '',
			),
			$atts
		);

		$url_args = array(
			'b' => $this->business_id,
			'n' => '1',
			's' => '0',
			'l' => '1',
			'i' => $atts['i'],
			'g' => $atts['g'],
			't' => $atts['t'],
			'f' => $atts['f'],
			'off' => $atts['off'],
			'out' => $atts['out'],
			'ln' => $atts['ln'],
			'n' => $atts['n']
		);

		$url_args = array_filter( $url_args, array( $this, 'remove_empty_url_args' ) );
		$url = add_query_arg( $url_args, $this->base_url . 'SingleHeadlinePluginData.asp?v=' . $this->version );
		$html = '<script src="' . esc_url( $url ) . '" type="text/javascript"></script>';
		return $html;
	}

	
	
	/**
	*********************************************************************************
	 * Define the Library plugin shortcode
	 * @since  0.1.0
	 * @return string
	*********************************************************************************
	 */
	public function library_headline_shortcode( $atts ) {
		
		$atts = shortcode_atts(
			array(
				'g' => '',
				't' => '',
				'f' => '',
				'i' => '5'
			),
			$atts
		);

		$url_args = array(
			'b' => $this->business_id,
			'n' => '1',
			's' => '0',
			'l' => '1',
			'i' => $atts['i'],
			'g' => $atts['g'],
			't' => $atts['t'],
			'f' => $atts['f'],
		);
		
		$url_args = array_filter( $url_args, array( $this, 'remove_empty_url_args' ) );
		$url = add_query_arg( $url_args, $this->base_url . 'HeadlinePlugin.asp?v=' . $this->version );
		$html = '<script src="' . esc_url( $url ) . '" type="text/javascript"></script>';
		return $html;
	}
	
	
	
	/**
	 *********************************************************************************
	 * Define the Contact us 2 plugin shortcode
	 * @since  0.8.3
	 * @return string
	 *********************************************************************************
	 */
	public function contactus_shortcode2( $atts ) {
		$html = '';
		$atts = shortcode_atts(
			array(
				'bizid' => '',
				'api' => '',
				'sdiv' => '',    // div name, set when using multiple on same page
				'class' => '',
				'h' => 'https'
			),
			$atts
		);

		$bizid = $this->business_id;
		$api = $this->key;
		if(esc_attr( $atts['bizid'])!='' && esc_attr( $atts['api'])!=''){
			$bizid = esc_attr( $atts['bizid']);
			$api = esc_attr( $atts['api']);
		}
		
		$contactdivname = 'ContactDiv';		
		if ( $atts['sdiv']!='' ) $contactdivname = esc_attr( $atts['sdiv'] );
		
		$html .= '<div id="' . $contactdivname . '" class="B2iContactContainer ' . $atts['class'] . '"></div>' . "\n";
		$html .= '<script src="' . esc_url(esc_attr( $atts['h'] ) . $this->base_url2 . 'Contactapi2.asp"?v=' . $this->version ) . '" type="text/javascript"></script>' . "\n";
		$html .= '<script type="text/javascript">' . "\n";
		$html .= 'oContact.BizID="' . $bizid . '";' . "\n";
		$html .= 'oContact.sKey="' . $api . '";' . "\n";
		$html .= ( $atts['h'] !== '' ) ? 'oContact.sHttp="' . esc_attr( $atts['h'] ) . '";' . "\n" : '';
		$html .= ( $atts['sdiv'] !== '' ) ? 'oContact.sDiv="' . esc_attr( $atts['sdiv'] ) . '";' . "\n" : '';
		$html .= 'getContactData();' . "\n";
		$html .= '</script>' . "\n";
		return $html;
	}



	/**
	 *********************************************************************************
	 * Define the Contact us plugin shortcode
	 * @since  0.7.0 ?
	 * @return string
	 *********************************************************************************
	 */
	public function contactus_shortcode( $atts ) {
		$html = '';
		$atts = shortcode_atts(
			array(
				'h' => 'https',
				'sdiv' => '',
				'n' => '',
				'isw' => '',
				'ish' => ''
			),
			$atts
		);
		
		$contactdivname = 'ContactDiv';		
		if ( $atts['sdiv']!='' ) $contactdivname = esc_attr( $atts['sdiv'] );
		$html .= '<div id="' . $contactdivname . '"></div>' . "\n";
		$html .= '<script src="' . esc_url(esc_attr( $atts['h'] ) . $this->base_url2 . 'ContactUsApi.js?v=' . $this->version ) . '" type="text/javascript"></script>' . "\n";
		$html .= '<script type="text/javascript">' . "\n";
		$html .= 'oContact.BizID="' . $this->business_id . '";' . "\n";
		$html .= 'oContact.sKey="' . $this->key . '";' . "\n";
		$html .= ( $atts['h'] !== '' ) ? 'oContact.sHttp="' . esc_attr( $atts['h'] ) . '";' . "\n" : '';
		$html .= ( $atts['sdiv'] !== '' ) ? 'oContact.sDiv="' . esc_attr( $atts['sdiv'] ) . '";' . "\n" : '';
		$html .= ( $atts['n'] !== '' ) ? 'oContact.sNav="' . esc_attr( $atts['n'] ) . '";' . "\n" : '';
		$html .= ( $atts['isw'] !== '' ) ? 'oContact.iStoryWidth="' . esc_attr( $atts['isw'] ) . '";' . "\n" : '';
		$html .= ( $atts['ish'] !== '' ) ? 'oContact.iStoryHeight="' . esc_attr( $atts['ish'] ) . '";' . "\n" : '';
		$html .= 'getContactData();' . "\n";
		$html .= '</script>' . "\n";
		return $html;
	}

	
	
	/**
	 **********************************************************************************
	 * Define the Request info 2 plugin shortcode
	 * @since  0.8.4
	 * @return string
	 **********************************************************************************
	 */
	public function request_optin_shortcode2( $atts ) {
		$html = '';
		$atts = shortcode_atts(
			array(
				'bizid' => '',
				'api' => '',
				'h' => 'https',
				'sdiv' => '',
				'g' => '',
				'list' => '',
				'listsort' => '',
				'lo' => '',
				'lang' => ''
			),
			$atts
		);

		$bizid = $this->business_id;
		$api = $this->key;
		if(esc_attr( $atts['bizid'])!='' && esc_attr( $atts['api'])!=''){
			$bizid = esc_attr( $atts['bizid']);
			$api = esc_attr( $atts['api']);
		}
		
		$requestdivname = 'RequestDiv';		
		if ( $atts['sdiv']!='' ) $requestdivname = esc_attr( $atts['sdiv'] );
		$html .= '<div id="' . $requestdivname . '" class="B2iRequestContainer"></div>' . "\n";
		$html .= '<script src="' . esc_url(esc_attr( $atts['h'] ) . $this->base_url2 . 'Requestapi2.asp?v=' . $this->version ) . '" type="text/javascript"></script>' . "\n";
		$html .= '<script type="text/javascript">' . "\n";
		$html .= 'oRequest.BizID="' . $bizid . '";' . "\n";
		$html .= 'oRequest.sKey="' . $api . '";' . "\n";
		$html .= ( $atts['h'] !== '' ) ? 'oRequest.sHttp="' . esc_attr( $atts['h'] ) . '";' . "\n" : '';
		$html .= ( $atts['sdiv'] !== '' ) ? 'oRequest.sDiv="' . esc_attr( $atts['sdiv'] ) . '";' . "\n" : '';
		$html .= ( $atts['g'] !== '' ) ? 'oRequest.Group="' . esc_attr( $atts['g'] ) . '";' . "\n" : '';
		$html .= ( $atts['lo'] !== '' ) ? 'oRequest.lo="' . esc_attr( $atts['lo'] ) . '";' . "\n" : '';
		$html .= ( $atts['lang'] !== '' ) ? 'oRequest.LangID="' . esc_attr( $atts['lang'] ) . '";' . "\n" : '';
		$html .= ( $atts['list'] !== '' ) ? 'oRequest.List="' . esc_attr( $atts['list'] ) . '";' . "\n" : '';
		$html .= ( $atts['listsort'] !== '' ) ? 'oRequest.ListSort="' . esc_attr( $atts['listsort'] ) . '";' . "\n" : '';
		$html .= 'getRequestData();' . "\n";
		$html .= '</script>' . "\n";
		return $html;
	}



	/**
	 **********************************************************************************
	 * Define the Request info Opt-in plugin shortcode
	 * @since  0.7.2
	 * @return string
	 **********************************************************************************
	 */
	public function request_optin_shortcode( $atts ) {
		$html = '';
		$atts = shortcode_atts(
			array(
				'bizid' => '',
				'api' => '',
				'h' => 'https',
				'sdiv' => '',
				'lang' => '',
				'g' => '',
				'list' => '',
				'listsort' => '',
				'isw' => '',
				'ish' => ''
			),
			$atts
		);

		$bizid = $this->business_id;
		$api = $this->key;
		if(esc_attr( $atts['bizid'])!='' && esc_attr( $atts['api'])!=''){
			$bizid = esc_attr( $atts['bizid']);
			$api = esc_attr( $atts['api']);
		}
		
		$requestdivname = 'RequestDiv';		
		if ( $atts['sdiv']!='' ) $requestdivname = esc_attr( $atts['sdiv'] );
		$html .= '<div id="' . $requestdivname . '"></div>' . "\n";
		$html .= '<script src="' . esc_url(esc_attr( $atts['h'] ) . $this->base_url2 . 'RequestApi.js?v=' . $this->version ) . '" type="text/javascript"></script>' . "\n";
		$html .= '<script type="text/javascript">' . "\n";
		$html .= 'oRequest.BizID="' . $bizid . '";' . "\n";
		$html .= 'oRequest.sKey="' . $api . '";' . "\n";
		$html .= ( $atts['h'] !== '' ) ? 'oRequest.sHttp="' . esc_attr( $atts['h'] ) . '";' . "\n" : '';
		$html .= ( $atts['sdiv'] !== '' ) ? 'oRequest.sDiv="' . esc_attr( $atts['sdiv'] ) . '";' . "\n" : '';
		$html .= ( $atts['g'] !== '' ) ? 'oRequest.Group="' . esc_attr( $atts['g'] ) . '";' . "\n" : '';
		$html .= ( $atts['lang'] !== '' ) ? 'oRequest.LangID="' . esc_attr( $atts['lang'] ) . '";' . "\n" : '';
		$html .= ( $atts['list'] !== '' ) ? 'oRequest.List="' . esc_attr( $atts['list'] ) . '";' . "\n" : '';
		$html .= ( $atts['listsort'] !== '' ) ? 'oRequest.ListSort="' . esc_attr( $atts['listsort'] ) . '";' . "\n" : '';
		$html .= ( $atts['isw'] !== '' ) ? 'oRequest.iStoryWidth="' . esc_attr( $atts['isw'] ) . '";' . "\n" : '';
		$html .= ( $atts['ish'] !== '' ) ? 'oRequest.iStoryHeight="' . esc_attr( $atts['ish'] ) . '";' . "\n" : '';
		$html .= 'getRequestData();' . "\n";
		$html .= '</script>' . "\n";
		return $html;
	}



	/**
	 **********************************************************************************
	 * Define the Profile plugin shortcode
	 * @since  0.7.2
	 * @return string
	 **********************************************************************************
	 */
	public function myprofile_shortcode( $atts ) {
		$html = '';
		$atts = shortcode_atts(
			array(
				'h' => 'https',
				'sdiv' => '',
				'lang' => '',
				'isw' => '',
				'ish' => ''
			),
			$atts
		);

		$profiledivname = 'ProfileDiv';		
		if ( $atts['sdiv']!='' ) $profiledivname = esc_attr( $atts['sdiv'] );
		$html .= '<div id="' . $profiledivname . '"></div>' . "\n";
		$html .= '<script src="' . esc_url(esc_attr( $atts['h'] ) . $this->base_url2 . 'ProfileApi.js?v=' . $this->version ) . '" type="text/javascript"></script>' . "\n";
		$html .= '<script type="text/javascript">' . "\n";
		$html .= 'oProfile.BizID="' . $this->business_id . '";' . "\n";
		$html .= 'oProfile.sKey="' . $this->key . '";' . "\n";
		$html .= ( $atts['h'] !== '' ) ? 'oProfile.sHttp="' . esc_attr( $atts['h'] ) . '";' . "\n" : '';
		$html .= ( $atts['sdiv'] !== '' ) ? 'oProfile.sDiv="' . esc_attr( $atts['sdiv'] ) . '";' . "\n" : '';
		$html .= ( $atts['lang'] !== '' ) ? 'oProfile.LangID="' . esc_attr( $atts['lang'] ) . '";' . "\n" : '';
		$html .= ( $atts['isw'] !== '' ) ? 'oProfile.iStoryWidth="' . esc_attr( $atts['isw'] ) . '";' . "\n" : '';
		$html .= ( $atts['ish'] !== '' ) ? 'oProfile.iStoryHeight="' . esc_attr( $atts['ish'] ) . '";' . "\n" : '';
		$html .= 'getProfileData();' . "\n";
		$html .= '</script>' . "\n";
		return $html;
	}
	
	
	
	/**
	 **********************************************************************************
	 * Define the Profile 2 plugin shortcode
	 * @since  0.8.4
	 * @return string
	 **********************************************************************************
	 */
	public function myprofile_shortcode2( $atts ) {
		$html = '';
		$atts = shortcode_atts(
			array(
				'h' => 'https',
				'sdiv' => '',
				'lang' => '',
				'isw' => '',
				'ish' => ''
			),
			$atts
		);

		$profiledivname = 'ProfileDiv';		
		if ( $atts['sdiv']!='' ) $profiledivname = esc_attr( $atts['sdiv'] );
		$html .= '<div id="' . $profiledivname . '"></div>' . "\n";
		$html .= '<script src="' . esc_url(esc_attr( $atts['h'] ) . $this->base_url2 . 'ProfileApi2.asp?v=' . $this->version ) . '" type="text/javascript"></script>' . "\n";
		$html .= '<script type="text/javascript">' . "\n";
		$html .= 'oProfile.BizID="' . $this->business_id . '";' . "\n";
		$html .= 'oProfile.sKey="' . $this->key . '";' . "\n";
		$html .= ( $atts['h'] !== '' ) ? 'oProfile.sHttp="' . esc_attr( $atts['h'] ) . '";' . "\n" : '';
		$html .= ( $atts['sdiv'] !== '' ) ? 'oProfile.sDiv="' . esc_attr( $atts['sdiv'] ) . '";' . "\n" : '';
		$html .= ( $atts['lang'] !== '' ) ? 'oProfile.LangID="' . esc_attr( $atts['lang'] ) . '";' . "\n" : '';
		$html .= 'getProfileData();' . "\n";
		$html .= '</script>' . "\n";
		return $html;
	}
	
	
	
	/**
	*********************************************************************************
	 * Define the CorpProfile plugin shortcode
	 * @since  0.8.9
	 * @return string
	*********************************************************************************
	 */
	public function corpprofile_shortcode( $atts ) {
		$html = '';
		$atts = shortcode_atts(
			array(
				'sdiv' => '',
				'css' => '1',
				'o' => '1'
			),
			$atts
		);
		
		$corpprofiledivname = 'CorpProfileDiv';		
		if ( $atts['sdiv']!='' ) $corpprofiledivname = esc_attr( $atts['sdiv'] );
		
		$html .= '<div id="' . $corpprofiledivname . '"></div>' . "\n";
		$html .= '<script src="https' . $this->base_url2 . 'CorpProfileapi.asp?v=' . $this->version . '" type="text/javascript"></script>' . "\n";
		$html .= '<script type="text/javascript">' . "\n";
		$html .= 'oCorpProfile.BizID="' . $this->business_id . '";' . "\n";
		$html .= 'oCorpProfile.sKey="' . $this->key . '";' . "\n";
		$html .= 'oCorpProfile.sDiv="' . $corpprofiledivname . '";' . "\n";
		$html .= 'oCorpProfile.css="' . esc_attr( $atts['css'] ) . '";' . "\n";
		$html .= ( $atts['o'] !== '1' ) ? 'oCorpProfile.o="' . esc_attr( $atts['o'] ) . '";' . "\n" : '';
		$html .= 'getCorpProfileData();' . "\n";
		$html .= '</script>' . "\n";
		return $html;
	}
	
	
	
	/**
	*********************************************************************************
	 * Define the Chart  plugin shortcode
	 * @since  0.1.0
	 * @return string
	*********************************************************************************
	 */
	public function Chart_shortcode( $atts ) {
		$html = '';
		$dollarsign='';
		$atts = shortcode_atts(
			array(
				'bizid' => '',
				'api' => '',
				'sdiv' => 'chartdiv',
				'h' => 'https',
				's' => '',
				'sd' => '',
				'e' => '',
				'ds' => '1',
				'lang' => '1',
				'c' => '003399',
				'lc' => '666666',
				'ls' => '15',
				'lc2' => '666666',
				'ls2' => '11',
				'lc3' => '333333',
				'ls3' => '20',
				'la3' => '0.2',
				'cc' => '003399',
				'bgc' => 'ffffff',
				'bga' => '1.0',
				'cbc' => '999999',
				'cba' => '0.5',
				'bs' => '13',
				'bc' => '003399',
				'p' => '3m',
				'height' => '500px',
				'width' => '96%',
				'sp' => '1',
				'sc' => '1',
				'ssb' => '1',
				'sv' => '1',
				'lm' => '13',
				'rm' => '5',
				'tm' => '5',
				'bm' => '5',
				'vic' => '1',
				'ct' => 'line',
				'vls' => 'left',
				'vct' => 'column',
				'vfa' => '.9',
				'fa' => '0.2',
				'ca' => '0.1',
				'stl' => '1',
				'sil' => '1',
				'lt' => '2',
				'ps' => 'bottom',
				'centsep' => '.',
				'thoussep' => ',',
				'volumetext' => 'Volume',
				'pricetext' => 'Price',
				'ga' => '.2',
				'gc' => 'bbbbbb',
				'udg' => '0',
				'mode' => '0',
				'class' => '',
				'ulc' => '4CAF50',
				'ufc' => '4CAF50',
				'dlc' => 'ff0000',
				'dfc' => 'ff0000'
			),
			$atts
		);


switch ($atts['ds']) {
  case '0':
	$dollarsign='';
	break;
  case '1':
	$dollarsign='$';
	break;
  case '2':
	$dollarsign='\u20AC';
	break;
  case '3':
	$dollarsign='\u00A3';
	break;
  case '4':
	$dollarsign='\u20AA';
	break;
}


$bizid = $this->business_id;
$api = $this->key;
$ticker = $this->ticker;

if(esc_attr( $atts['bizid'])!=''){
	$bizid = esc_attr( $atts['bizid']);
}

if(esc_attr( $atts['api'])!=''){
	$api = esc_attr( $atts['api']);
}

if(esc_attr( $atts['s'])!=''){
	$ticker = esc_attr( $atts['s']);
}


if($atts['ct']=='candlestick' || $atts['ct']=='ohlc') $atts['mode']="1";

$html .= '<div id="' . esc_attr( $atts['sdiv'] ) . '" class="B2iChartContainer ' . $atts['class'] . '" style="height: ' . esc_attr( $atts['height'] ) . '; width:' . esc_attr( $atts['width'] ) . ';"></div>' . "\n";
//$html .= '<script src="' . esc_url(esc_attr( $atts['h'] ) . $this->base_url3 . 'profiles/inc/amstockgetJsData.asp?b=' ) . $this->business_id . '&s=' . esc_attr( $atts['s'] ) . '" type="text/javascript"></script>' . "\n";


$html .= '<script src="https://stockcharting.s3.amazonaws.com/amcharts.js" type="text/javascript"></script>' . "\n";
$html .= '<script src="https://stockcharting.s3.amazonaws.com/serial.js" type="text/javascript"></script>' . "\n";
$html .= '<script src="https://stockcharting.s3.amazonaws.com/amstock.js" type="text/javascript"></script>' . "\n";
$html .= '<script src="https://stockcharting.s3.amazonaws.com/export.js" type="text/javascript"></script>' . "\n";
$html .= '<style src="https://stockcharting.s3.amazonaws.com/export.css" type="text/css"></style>' . "\n";
$html .= '<style src="https://stockcharting.s3.amazonaws.com/style.css" type="text/css"></style>' . "\n";
$html .= '<style src="https://www.b2i.us/profiles/inc/CSS.asp?m=5&b=' . $bizid . '&api=' . $api . '" type="text/javascript"></style>' . "\n";
$html .= '<script src="https://www.b2i.us/profiles/inc/amstockgetJsData2.asp?b=' . $bizid . '&api=' . $api . '&s=' . $ticker . '&m=' . esc_attr( $atts['mode'] ) . '" type="text/javascript"></script>' . "\n";
$html .= '<script type="text/javascript">' . "\n";
$html .= 'var chartData = [];' . "\n";
$html .= 'loadData();' . "\n";

if ($atts['lang']==2) {
$html .= 'AmCharts.monthNames = ["Eenero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"];' . "\n";
$html .= 'AmCharts.shortMontNames = ["Een","Feb","Mar","Abr","May","Jun","Jul","Ago","Sep","Oct","Nov","Dic"];' . "\n";
}

$html .= 'var chart = AmCharts.makeChart("' . esc_attr( $atts['sdiv'] ) . '", {type: "stock", ' . "\n";

$html .= ' pathToImages: "' . esc_url(esc_attr( $atts['h'] ) . $this->base_url3 . 'profiles/investor/ChartJS/images/') .'", dataSets: [{color: "#' . $atts['c'] . '",' . "\n";
$html .= 'title:"' . $atts['sd'] . '",' . "\n";
$html .= 'fieldMappings: [{' . "\n";
$html .= 'fromField: "price",' . "\n";
$html .= 'toField: "price"' . "\n";
$html .= '}, {' . "\n";
$html .= 'fromField: "open",' . "\n";
$html .= 'toField: "open"' . "\n";
$html .= '}, {' . "\n";
$html .= 'fromField: "high",' . "\n";
$html .= 'toField: "high"' . "\n";
$html .= '}, {' . "\n";
$html .= 'fromField: "low",' . "\n";
$html .= 'toField: "low"' . "\n";
$html .= '}, {' . "\n";
$html .= 'fromField: "volume",' . "\n";
$html .= 'toField: "volume"' . "\n";
$html .= '}, {' . "\n";
$html .= 'fromField: "svolume",' . "\n";
$html .= 'toField: "svolume"' . "\n";
$html .= '}, {' . "\n";
$html .= 'fromField: "svolume",' . "\n";
$html .= 'toField: "svolume"' . "\n";
$html .= '}],' . "\n";
$html .= ' dataProvider: chartData, categoryField: "date"' . "\n";
$html .= '}],' . "\n";
$html .= 'panels: [{' . "\n";
if($atts['sil']=="1"){
$html .= '"titles":[{"text":"' . $atts['e'] . ' ' . $atts['sd'] . '","size":' . $atts['ls3'] . ',"alpha":' . $atts['la3'] . ',"color":"#' . $atts['lc3'] . '"}],' . "\n";
}
$html .= 'thousandsSeparator:"' . $atts['thoussep'] . '", decimalSeparator:"' . $atts['centsep'] . '", showCategoryAxis: true,' . "\n";
$html .= 'title: "' . $atts['pricetext'] . '",' . "\n";
$html .= 'percentHeight: 75,' . "\n";

$html .= 'valueAxes:[{' . "\n";
$html .= 'gridAlpha: "' . $atts['ga'] . '"' . "\n";

if($atts['udg']=="1"){
$html .= ',"dashLength":5' . "\n";
}
$html .= '}],' . "\n";
$html .= 'categoryAxis:{' . "\n";
$html .= 'gridAlpha: "' . $atts['ga'] . '",' . "\n";
if($atts['udg']=="1"){
$html .= '"dashLength":5,' . "\n";
}
$html .= '"parseDates":true },' . "\n";
$html .= 'stockGraphs: [{' . "\n";
$html .= 'id: "g1",' . "\n";
$html .= 'type: "' . $atts['ct'] . '",' . "\n";
$html .= 'lineThickness: ' . $atts['lt'] . ',' . "\n";
$html .= 'openField: "open",' . "\n";
$html .= 'closeField: "price",' . "\n";
$html .= 'highField: "high",' . "\n";
$html .= 'lowField: "low",' . "\n";
$html .= 'volumeField: "volume",' . "\n";
$html .= 'valueField: "price",' . "\n";
$html .= 'fillAlphas: ' . $atts['fa'] . ',' . "\n";

$html .= 'lineColor:  "#' . $atts['ulc'] . '",' . "\n";
$html .= 'fillColors: "#' . $atts['ufc'] . '",' . "\n";
$html .= 'negativeLineColor: "#' . $atts['dlc'] . '",' . "\n";
$html .= 'negativeFillColors: "#' . $atts['dfc'] . '",' . "\n";
if($atts['mode']=="1"){
	$html .= 'useDataSetColors: false,' . "\n";
}

if($atts['mode']=="0"){
	$html .= 'balloonText:"<div style=\"\"><div style=\"text-align:center;font-weight:bold;padding:5px 5px;\">[[category]]</div></div><div style=\"display:table-row;\"><div class=\"chartballon chartstockpricedate\" style=\"display:table-cell;padding:2px;font-size:90%;\">Close</div><div class=\"chartballon chartstockprice\" style=\"display:table-cell;text-align:right;font-weight:bold;padding:2px;\">' . $dollarsign . '[[value]]</div></div>"';
}else{
	$html .= 'balloonText:"<div><div style=\"font-weight:bold;padding:3px 5px;\">[[category]]</div></div><div style=\"display:table-row;\"><div style=\"display:table-cell;padding:3px 5px;\">Open: </div><div style=\"display:table-cell;padding:3px 5px;text-align:right;\">' . $dollarsign . '[[open]]</div></div><div style=\"display:table-row;\"><div style=\"display:table-cell;padding:3px 5px;\">Close: </div><div style=\"display:table-cell;padding:3px 5px;text-align:right;\">' . $dollarsign . '[[close]] </div></div><div style=\"display:table-row;\"><div style=\"display:table-cell;padding:3px 5px;\">Low:</div><div style=\"display:table-cell;padding:3px 5px;text-align:right;\">' . $dollarsign . '[[low]] </div></div><div style=\"display:table-row;\"><div style=\"display:table-cell;padding:3px 5px;\">High:</div><div style=\"display:table-cell;padding:3px 5px;text-align:right;\">' . $dollarsign . '[[high]]</div></div><div style=\"display:table-row;\"><div style=\"display:table-cell;padding:3px 5px;\">Volume:</div><div style=\"display:table-cell;padding:3px 5px;text-align:right;\">[[svolume]]</div></div>"' . "\n";
}

$html .= '}]' . "\n";
if($atts['stl']=='1'){
$html .= ',stockLegend: {' . "\n";
$html .= 'fontSize: ' . $atts['bs'] . ',' . "\n";
$html .= 'valueTextRegular: " ' . $dollarsign . '[[value]]",' . "\n";
$html .= 'markerType: "none"' . "\n";
$html .= '}' . "\n";
}
$html .= '}' . "\n";

if ($atts['sv']==1) {
$html .= ',{' . "\n";
$html .= 'thousandsSeparator:"' . $atts['thoussep'] . '", decimalSeparator:"' . $atts['centsep'] . '",showCategoryAxis: false,' . "\n";
$html .= 'title: "' . $atts['volumetext'] . '",' . "\n";
$html .= 'percentHeight: 25,' . "\n";

$html .= 'valueAxes:[{' . "\n";
$html .= 'gridAlpha: "' . $atts['ga'] . '"' . "\n";
	if($atts['udg']=="1"){
$html .= ',"dashLength":5' . "\n";
	}
$html .= '}],' . "\n";

$html .= 'categoryAxis:{' . "\n";
$html .= 'gridAlpha: "' . $atts['ga'] . '"' . "\n";
	if($atts['udg']=="1"){
$html .= ',"dashLength":5,' . "\n";
	}
$html .= '},' . "\n";

$html .= 'stockGraphs: [{' . "\n";
$html .= 'valueField: "volume",' . "\n";
$html .= 'type: "' . $atts['vct'] . '",' . "\n";
$html .= 'cornerRadiusTop: 1,' . "\n";
$html .= 'fillAlphas: ' . $atts['vfa'] . ',' . "\n";
$html .= 'balloonText:"<span style=\"line-height:20px;\">Date: <b>[[category]]</b><br>' . $atts['volumetext'] . ': <b>[[value]]</b></span>"' . "\n";
$html .= '}],' . "\n";
$html .= 'stockLegend: {' . "\n";
$html .= 'valueTextRegular: " [[value]]",' . "\n";
$html .= 'markerType: "none"' . "\n";
$html .= '}' . "\n";
$html .= '}' . "\n";
}

$html .= '],' . "\n";
$html .= 'chartCursorSettings: {' . "\n";
if ($atts['sc']==0) {
$html .= 'enabled:false,' . "\n";
}else{
$html .= 'valueBalloonsEnabled: true,' . "\n";
$html .= 'fullWidth: true,' . "\n";
$html .= 'cursorAlpha: ' . $atts['ca'] . ',' . "\n";
$html .= 'cursorColor: "#' . $atts['cc'] . '",' . "\n";
$html .= 'graphBulletSize: 1,' . "\n";
$html .= 'valueLineBalloonEnabled:true,' . "\n";
$html .= 'valueLineEnabled:true,' . "\n";
$html .= 'valueLineAlpha: 0.5' . "\n";
}
$html .= '},' . "\n";
$html .= 'legendSettings: {' . "\n";
$html .= 'color: "#' . $atts['lc'] . '"' . "\n";
$html .= ',fontSize:' . $atts['ls'] . '' . "\n";
$html .= '},' . "\n";
$html .= 'balloon: {' . "\n";
$html .= 'maxWidth:320,' . "\n";
$html .= 'horizontalPadding: 5,' . "\n";
$html .= 'verticalPadding: 3,' . "\n";
$html .= 'fontSize: 13,' . "\n";
$html .= 'textAlign:"left",' . "\n";
$html .= 'borderThickness:1,' . "\n";
$html .= 'borderColor: "#' . $atts['bc'] . '",' . "\n";
$html .= 'borderAlpha:0.8,' . "\n";
$html .= 'fillColor: "#FFFFFF",' . "\n";
$html .= 'cornerRadius: 3,' . "\n";
$html .= 'fillAlpha:1,' . "\n";
$html .= 'offsetX: 105,' . "\n";
$html .= 'offsetY: 105' . "\n";
$html .= '},' . "\n";

if ($atts['sp']=='1') {
$html .= 'periodSelector: {' . "\n";
$html .= 'inputFieldsEnabled: false,' . "\n";
$html .= 'position: "' . $atts['ps'] . '",' . "\n";
$html .= 'dateFormat: "MM-DD-YYYY",' . "\n";
$html .= 'periods: [{' . "\n";
$html .= 'period: "DD",' . "\n";
	if ( esc_attr( $atts['p'] )=='10d' ) $html .= 'selected: true,' . "\n";
$html .= 'count: 10,' . "\n";
$html .= 'label: "10 D"' . "\n";
$html .= '}, {' . "\n";
$html .= 'period: "MM",' . "\n";
	if ( esc_attr( $atts['p'] )=='1m' ) $html .= 'selected: true,' . "\n";
$html .= 'count: 1,' . "\n";
$html .= 'label: "1 M"' . "\n";
$html .= '}, {' . "\n";
$html .= 'period: "MM",' . "\n";
	if ( esc_attr( $atts['p'] )=='3m' ) $html .= 'selected: true,' . "\n";
$html .= 'count: 3,' . "\n";
$html .= 'label: "3 M"' . "\n";
$html .= '}, {' . "\n";
$html .= 'period: "MM",' . "\n";
	if ( esc_attr( $atts['p'] )=='6m' ) $html .= 'selected: true,' . "\n";
$html .= 'count: 6,' . "\n";
$html .= 'label: "6 M"' . "\n";
$html .= '}, {' . "\n";
$html .= 'period: "YYYY",' . "\n";
	if ( esc_attr( $atts['p'] )=='1y' ) $html .= 'selected: true,' . "\n";
$html .= 'count: 1,' . "\n";
$html .= 'label: "1 Y"' . "\n";
$html .= '}, {' . "\n"; 
$html .= 'period: "YYYY",' . "\n";
	if ( esc_attr( $atts['p'] )=='1y' ) $html .= 'selected: true,' . "\n";
$html .= 'count: 5,' . "\n";
$html .= 'label: "5 Y"' . "\n";
$html .= '}, {' . "\n";
$html .= 'period: "MAX",' . "\n";
	if ( esc_attr( $atts['p'] )=='max' ) $html .= 'selected: true,' . "\n";
$html .= 'label: "ALL"' . "\n";
$html .= '}]' . "\n";
$html .= '},' . "\n";
}
$html .= 'panelsSettings: {' . "\n";
$html .= 'usePrefixes: true,' . "\n";
$html .= 'color: "#' . $atts['lc2'] . '",' . "\n";
$html .= 'fontSize: "' . $atts['ls2'] . '",' . "\n";
$html .= 'plotAreaFillColors: "#' . $atts['bgc'] . '",' . "\n";
$html .= 'plotAreaFillAlphas: ' . $atts['bga'] . ',' . "\n";
$html .= 'plotAreaBorderColor: "#' . $atts['cbc'] . '",' . "\n";
$html .= 'plotAreaBorderAlpha: ' . $atts['cba'] . ',' . "\n";
$html .= 'marginLeft:' . $atts['lm'] . ',' . "\n";
$html .= 'marginRight:' . $atts['rm'] . ',' . "\n";
$html .= 'marginTop:' . $atts['tm'] . ',' . "\n";
$html .= 'marginBottom:' . $atts['bm'] . ',' . "\n";
$html .= 'creditsPosition: "top-left"' . "\n";
$html .= ',addClassNames: true' . "\n";
$html .= '},' . "\n";
$html .= 'valueAxesSettings: {' . "\n";
$html .= 'gridColor: "#' . $atts['gc'] . '",' . "\n";
$html .= 'position: "' . $atts['vls'] . '"' . "\n";
if ($atts['vic']==0) {
$html .= ',inside: false' . "\n";
}
$html .= '},' . "\n";
$html .= 'chartScrollbarSettings: {' . "\n";
$html .= 'graph:"g1"' . "\n";
$html .= ',selectedBackgroundColor: "#' . $atts['bgc'] . '"' . "\n";
$html .= ',selectedGraphFillColor: "#' . $atts['c'] . '"' . "\n";
$html .= ',selectedGraphLineColor: "#' . $atts['c'] . '"' . "\n";
$html .= ',selectedGraphFillAlpha: .1' . "\n";
$html .= ',selectedGraphLineAlpha: 1' . "\n";
$html .= ',graphFillColor: "#e7e7e7"' . "\n";
$html .= ',backgroundColor: "#' . $atts['bgc'] . '"' . "\n";
if ($atts['ssb']==0) {
$html .= ',enabled:false' . "\n";
}
$html .= '},' . "\n";
$html .= 'categoryAxesSettings: {' . "\n";
$html .= 'gridColor: "#' . $atts['gc'] . '",' . "\n";
$html .= 'startOnAxis: true,' . "\n";
$html .= 'equalSpacing: true,' . "\n";

if($atts['mode']=="1"){ $html .= ' maxSeries:15000' . "\n"; }
$html .= '}' . "\n";
$html .= '});' . "\n";


$html .= '</script>' . "\n";
	return $html;
}



	/**
	*********************************************************************************
	 * Define the Intraday Chart  plugin shortcode
	 * @since  0.1.0
	 * @return string
	*********************************************************************************
	 */
	public function intradaychart_shortcode( $atts ) {
		$html = '';
		$dollarsign='';
		$atts = shortcode_atts(
			array(
				'bizid' => '',
				'api' => '',
				'sdiv' => 'ichartdiv',
				'h' => 'https',
				's' => '',
				'sd' => '',
				'e' => '',
				'ds' => '1',
				'lang' => '1',
				'c' => '003399',
				'lc' => '666666',
				'ls' => '15',
				'lc2' => '666666',
				'ls2' => '11',
				'lc3' => '333333',
				'ls3' => '20',
				'la3' => '0.2',
				'cc' => '003399',
				'bgc' => 'ffffff',
				'bga' => '1.0',
				'cbc' => '999999',
				'cba' => '0.5',
				'bs' => '13',
				'bc' => '003399',
				'p' => '3m',
				'height' => '500px',
				'width' => '96%',
				'sp' => '1',
				'sc' => '1',
				'ssb' => '1',
				'sv' => '0',
				'lm' => '13',
				'rm' => '5',
				'tm' => '5',
				'bm' => '5',
				'vic' => '1',
				'ct' => 'line',
				'vls' => 'left',
				'vct' => 'column',
				'vfa' => '.9',
				'fa' => '0.2',
				'ca' => '0.1',
				'stl' => '1',
				'sil' => '1',
				'lt' => '2',
				'ps' => 'bottom',
				'centsep' => '.',
				'thoussep' => ',',
				'volumetext' => 'Volume',
				'pricetext' => 'Price',
				'ga' => '.2',
				'gc' => 'bbbbbb',
				'class' => '',
				'udg' => '0'
			),
			$atts
		);
if($atts['sd']=='')
	$atts['sd'] = $ticker;

switch ($atts['ds']) {
  case '0':
	$dollarsign='';
	break;
  case '1':
	$dollarsign='$';
	break;
  case '2':
	$dollarsign='\u20AC';
	break;
  case '3':
	$dollarsign='\u00A3';
	break;
  case '4':
	$dollarsign='\u20AA';
	break;
}

$bizid = $this->business_id;
$api = $this->key;
$ticker = $this->ticker;

if(esc_attr( $atts['bizid'])!=''){
	$bizid = esc_attr( $atts['bizid']);
}

if(esc_attr( $atts['api'])!=''){
	$api = esc_attr( $atts['api']);
}

if(esc_attr( $atts['s'])!=''){
	$ticker = esc_attr( $atts['s']);
}

$html .= '<div id="' . esc_attr( $atts['sdiv'] ) . '" class="B2iIntraChartContainer ' . $atts['class'] . '" style="height: ' . esc_attr( $atts['height'] ) . '; width:' . esc_attr( $atts['width'] ) . ';"></div>' . "\n";
$html .= '<script src="https://stockcharting.s3.amazonaws.com/amcharts.js" type="text/javascript"></script>' . "\n";
$html .= '<script src="https://stockcharting.s3.amazonaws.com/serial.js" type="text/javascript"></script>' . "\n";
$html .= '<script src="https://stockcharting.s3.amazonaws.com/amstock.js" type="text/javascript"></script>' . "\n";
$html .= '<script src="https://stockcharting.s3.amazonaws.com/export.js" type="text/javascript"></script>' . "\n";
$html .= '<script src="https://stockcharting.s3.amazonaws.com/export.js" type="text/javascript"></script>' . "\n";
$html .= '<style src="https://stockcharting.s3.amazonaws.com/export.css" type="text/css"></style>' . "\n";
$html .= '<style src="https://stockcharting.s3.amazonaws.com/style.css" type="text/css"></style>' . "\n";
$html .= '<style src="https://www.b2i.us/profiles/inc/CSS.asp?m=5&b=' . $bizid . '&api=' . $api . '" type="text/javascript"></style>' . "\n";
$html .= '<script src="https://www.b2i.us/profiles/inc/amstockIntraGetJsData.asp?b=' . $bizid . '&api=' . $api . '&s=' . $ticker . '" type="text/javascript"></script>' . "\n";
$html .= '<script type="text/javascript">' . "\n";
$html .= 'var chartIntraData = [];' . "\n";
$html .= 'loadIntraData();' . "\n";

$html .= 'var ichart = AmCharts.makeChart("' . esc_attr( $atts['sdiv'] ) . '", {type: "stock", addClassNames: true, "responsive":{"enabled": true },' . "\n";

$html .= ' pathToImages: "' . esc_url(esc_attr( $atts['h'] ) . $this->base_url3 . 'profiles/investor/ChartJS/images/') .'", ';
$html .= ' dataSets: [{color: "#' . $atts['c'] . '",' . "\n";
$html .= 'title:"' . $atts['sd'] . '",' . "\n";
$html .= 'fieldMappings: [{"fromField": "price", "toField": "price"}],' . "\n";
$html .= ' dataProvider: chartIntraData, categoryField: "date", "dataformat":"mm"' . "\n";
$html .= '}],' . "\n";


$html .= 'panels: [{ "showCategoryAxis": true,' . "\n";

if($atts['sil']=="1"){
$html .= '"titles":[{"text":"' . $atts['e'] . ' ' . $atts['sd'] . '","size":' . $atts['ls3'] . ',"alpha":' . $atts['la3'] . ',"color":"#' . $atts['lc3'] . '"}],' . "\n";
}

$html .= 'thousandsSeparator:"' . $atts['thoussep'] . '", decimalSeparator:"' . $atts['centsep'] . '",' . "\n";
$html .= 'title: "' . $atts['pricetext'] . '",' . "\n";
$html .= 'percentHeight: 100,' . "\n";

$html .= 'valueAxes:[{' . "\n";
$html .= '"id": "v1", gridAlpha: "' . $atts['ga'] . '", parseDates: true' . "\n";
if($atts['udg']=="1"){
$html .= ',"dashLength":5' . "\n";
}
$html .= '}],' . "\n";

$html .= 'categoryAxis:{' . "\n";
$html .= 'gridAlpha: "' . $atts['ga'] . '",' . "\n";
if($atts['udg']=="1"){
$html .= '"dashLength":5,' . "\n";
}
$html .= '"parseDates":true,"dateFormats":[{"period":"mm","format":"LL:NN"},{"period":"hh","format":"LL:NN"}] },' . "\n";

$html .= 'stockGraphs: [{' . "\n";
$html .= 'id: "g1",' . "\n";
$html .= 'type: "' . $atts['ct'] . '",' . "\n";
$html .= 'lineThickness: ' . $atts['lt'] . ',' . "\n";
$html .= 'valueField: "price",' . "\n";
$html .= 'fillAlphas: ' . $atts['fa'] . ',' . "\n";
$html .= 'balloonText:"<div class=\"stockchartballoon\" style=\"display:table-row;\"><div style=\"display:table-cell;text-align:right;font-weight:bold;padding:3px;\">Time:</div><div style=\"display:table-cell;text-align:left;font-weight:bold;padding:3px;\">[[category]]</div></div>';
$html .= '<div style=\"display:table-row;\"><div class=\"chartballon chartstockpricedate\" style=\"display:table-cell;padding:3px;font-size:90%;\">Close</div><div class=\"chartballon chartstockprice\" style=\"display:table-cell;text-align:right;font-weight:bold;padding:3px;\">' . $dollarsign . '[[value]]</div></div>"';
$html .= '}]' . "\n";

if($atts['stl']=='1'){
$html .= ',stockLegend: {' . "\n";
$html .= 'fontSize: ' . $atts['bs'] . ',' . "\n";
$html .= 'valueTextRegular: " ' . $dollarsign . '[[value]]",' . "\n";
$html .= 'markerType: "none", "valueAlign":"left"' . "\n";
$html .= '}' . "\n";
}
$html .= '}' . "\n";


$html .= '],' . "\n";
$html .= 'chartCursorSettings: {' . "\n";
if ($atts['sc']==0) {
$html .= 'enabled:false,' . "\n";
}else{
$html .= 'valueBalloonsEnabled: true,' . "\n";
$html .= 'fullWidth: true,' . "\n";
$html .= 'cursorAlpha: ' . $atts['ca'] . ',' . "\n";
$html .= 'cursorColor: "#' . $atts['cc'] . '",' . "\n";
$html .= 'graphBulletSize: 1,' . "\n";
$html .= 'valueLineBalloonEnabled:true,' . "\n";
$html .= 'valueLineEnabled:true,' . "\n";
$html .= 'valueLineAlpha: 0.7,' . "\n";
$html .= 'leaveAfterTouch:true,' . "\n";
$html .= '"minPeriod": "mm",' . "\n";
$html .= '"cursorPosition":"mouse",' . "\n";
$html .= '"categoryBalloonDateFormats" :[{"period":"ss","format":"LL:NN:SS"},{"period":"mm","format":"LL:NN"},{"period":"hh","format":"LL:NN"}]' . "\n";
}
$html .= '},' . "\n";

$html .= '"chartCursor": { "categoryBalloonDateFormat":"LL:NN" },' . "\n";

$html .= 'legendSettings: {' . "\n";
$html .= 'color: "#' . $atts['lc'] . '"' . "\n";
$html .= ',fontSize:' . $atts['ls'] . '' . "\n";
$html .= '},' . "\n";
$html .= 'balloon: {' . "\n";
$html .= 'maxWidth:320,' . "\n";
$html .= 'horizontalPadding: 5,' . "\n";
$html .= 'verticalPadding: 3,' . "\n";
$html .= 'fontSize: 13,' . "\n";
$html .= 'textAlign:"left",' . "\n";
$html .= 'borderThickness:1,' . "\n";
$html .= 'borderColor: "#' . $atts['bc'] . '",' . "\n";
$html .= 'borderAlpha:0.8,' . "\n";
$html .= 'fillColor: "#FFFFFF",' . "\n";
$html .= 'cornerRadius: 3,' . "\n";
$html .= 'fillAlpha:1,' . "\n";
$html .= 'offsetY: 25, "animationDuration":0.2' . "\n";
$html .= '},' . "\n";

if ($atts['sp']=='1') {
$html .= 'periodSelector: {' . "\n";
$html .= 'inputFieldsEnabled: false,' . "\n";
$html .= 'position: "' . $atts['ps'] . '",' . "\n";
$html .= 'dateFormat: "YYYY-MM-DD JJ:NN",' . "\n";
$html .= 'periods: [{' . "\n";
$html .= 'period: "mm",' . "\n";
	if ( esc_attr( $atts['p'] )=='1h' ) $html .= 'selected: true,' . "\n";
$html .= 'count: 60,' . "\n";
$html .= 'label: "1 h"' . "\n";
$html .= '}, {' . "\n";
$html .= 'period: "mm",' . "\n";
	if ( esc_attr( $atts['p'] )=='2h' ) $html .= 'selected: true,' . "\n";
$html .= 'count: 120,' . "\n";
$html .= 'label: "2 h"' . "\n";
$html .= '}, {' . "\n";
$html .= 'period: "mm",' . "\n";
	if ( esc_attr( $atts['p'] )=='4h' ) $html .= 'selected: true,' . "\n";
$html .= 'count: 240,' . "\n";
$html .= 'label: "4 h"' . "\n";
$html .= '}, {' . "\n";
$html .= 'period: "mm",' . "\n";
	if ( esc_attr( $atts['p'] )=='6h' ) $html .= 'selected: true,' . "\n";
$html .= 'count: 360,' . "\n";
$html .= 'label: "6 h"' . "\n";
$html .= '}, {' . "\n";
$html .= 'period: "MAX",' . "\n";
	if ( esc_attr( $atts['p'] )=='max' ) $html .= 'selected: true,' . "\n";
$html .= 'label: "ALL"' . "\n";
$html .= '}]' . "\n";
$html .= '},' . "\n";
}
$html .= 'panelsSettings: {' . "\n";
$html .= 'usePrefixes: true,' . "\n";
$html .= 'color: "#' . $atts['lc2'] . '",' . "\n";
$html .= 'fontSize: "' . $atts['ls2'] . '",' . "\n";
$html .= 'plotAreaFillColors: "#' . $atts['bgc'] . '",' . "\n";
$html .= 'plotAreaFillAlphas: ' . $atts['bga'] . ',' . "\n";
$html .= 'plotAreaBorderColor: "#' . $atts['cbc'] . '",' . "\n";
$html .= 'plotAreaBorderAlpha: ' . $atts['cba'] . ',' . "\n";
$html .= 'marginLeft:' . $atts['lm'] . ',' . "\n";
$html .= 'marginRight:' . $atts['rm'] . ',' . "\n";
$html .= 'marginTop:' . $atts['tm'] . ',' . "\n";
$html .= 'marginBottom:' . $atts['bm'] . ',' . "\n";
$html .= 'creditsPosition: "top-left"' . "\n";
$html .= ',addClassNames: true' . "\n";
$html .= '},' . "\n";
$html .= 'valueAxesSettings: {' . "\n";
$html .= 'gridColor: "#' . $atts['gc'] . '",' . "\n";
$html .= 'position: "' . $atts['vls'] . '"' . "\n";
if ($atts['vic']==0) {
$html .= ',inside: false' . "\n";
}
$html .= '},' . "\n";
$html .= 'chartScrollbarSettings: {' . "\n";
$html .= 'graph:"g1"' . "\n";
$html .= ',selectedBackgroundColor: "#' . $atts['bgc'] . '"' . "\n";
$html .= ',selectedGraphFillColor: "#' . $atts['c'] . '"' . "\n";
$html .= ',selectedGraphLineColor: "#' . $atts['c'] . '"' . "\n";
$html .= ',selectedGraphFillAlpha: .1' . "\n";
$html .= ',selectedGraphLineAlpha: 1' . "\n";
$html .= ',graphFillColor: "#e7e7e7"' . "\n";
$html .= ',backgroundColor: "#' . $atts['bgc'] . '"' . "\n";
if ($atts['ssb']==0) {
$html .= ',enabled:false' . "\n";
}
$html .= '},' . "\n";

$html .= 'categoryAxesSettings: {"minPeriod": "mm", gridColor: "#' . $atts['gc'] . '",startOnAxis: true, equalSpacing: true, "parseDates":true' . "\n";
$html .= '}' . "\n";

$html .= '});' . "\n";

$html .= '</script>' . "\n";

return $html;
}



	/**
	*********************************************************************************
	 */
	protected function remove_empty_url_args( $arg ) {
		return ( $arg !== '' );
	}
}
