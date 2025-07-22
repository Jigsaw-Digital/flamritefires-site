# SX Postcode Checker

A bespoke WordPress plugin that allows users to search for subsidence projects in their area using postcodes.

## Features

- Clean and intuitive postcode search interface
- Interactive Google Maps integration
- Customizable information display
- Multiple data source options:
  - CSV file with postcode, latitude, longitude, and count data
  - Custom post type with location metadata
- Fully customizable settings
- Responsive design
- Easy integration via shortcode

## Installation

1. Upload the `sx_postcode_checker` folder to the `/wp-content/plugins/` directory.
2. Activate the plugin through the 'Plugins' menu in WordPress.
3. Go to 'Postcode Checker' in the admin menu to configure settings.
4. Add your Google Maps API key in the settings.
5. Choose and configure your data source (CSV or Custom Post Type).
6. Use the shortcode `[sx_postcode_checker]` on any page to display the postcode checker.

## Configuration

### Google Maps Settings

- **API Key**: Your Google Maps API key (required for the map to work).
- **Map Zoom Level**: The zoom level (1-20) when a location is found.
- **Map Height**: The height of the map element (e.g., "500px").

### Data Source Settings

#### CSV File

- Upload a CSV file with the following columns:
  - `postcode`: The postcode
  - `latitude`: The latitude coordinate
  - `longitude`: The longitude coordinate
  - `count`: The number of subsidence projects in this postcode area

#### Custom Post Type

- **Post Type**: Select the post type that contains location data.
- **Latitude Field**: The meta key or ACF field name for latitude data.
- **Longitude Field**: The meta key or ACF field name for longitude data.
- Note: Posts should have a 'postcode' meta field that stores the postcode.

### Display Settings

- **Marker Title**: The title shown when hovering over a map marker.
- **Info Window Template**: The HTML template for the info window that appears when clicking a marker.

## Shortcode Usage

Use the following shortcode to display the postcode checker on any page:

```
[sx_postcode_checker]
```

Optional attributes:

- `map_height`: Override the map height (e.g., "600px").
- `map_zoom`: Override the zoom level (1-20).

Example:

```
[sx_postcode_checker map_height="600px" map_zoom="14"]
```

## User Experience

1. The user enters their postcode in the search bar and clicks "Search".
2. The map zooms to their location and displays a marker.
3. The marker shows information about the number of subsidence projects in that area.
4. A content box beside the map provides more details and a call-to-action link.

## Requirements

- WordPress 5.0 or higher
- PHP 7.0 or higher
- Google Maps API key