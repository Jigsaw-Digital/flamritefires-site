# Coverage Map Plugin

A WordPress plugin that provides engineer coverage functionality with postcode search and Google Maps integration.

## Features

- Custom post type for Coverage Points
- Interactive Google Maps with custom styling
- Postcode search functionality (UK postcodes)
- Distance calculation (30-mile radius)
- Shortcode for easy integration
- Tailwind CSS with prefix to avoid conflicts
- Fully responsive design

## Installation

1. Upload the `coverage-map` folder to your `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Configure your Google Maps API key in Settings > Coverage Map

## Configuration

### Google Maps API Key

1. Go to Settings > Coverage Map in your WordPress admin
2. Enter your Google Maps JavaScript API key
3. Save the settings

To get a Google Maps API key:
1. Visit the [Google Cloud Console](https://console.cloud.google.com/)
2. Create a new project or select an existing one
3. Enable the Google Maps JavaScript API
4. Create credentials (API key)
5. Optionally restrict the API key to your domain

## Usage

### Shortcode

Display the coverage map on any page or post using:

```
[coverage_map]
```

### Shortcode Parameters

- `title` - Override the default title (default: "Engineer Coverage")
- `subtitle` - Override the default subtitle (default: "Enter a postcode to find coverage in your area")
- `search_placeholder` - Override search placeholder text (default: "Enter postcode, town or city")
- `default_lat` - Set default map latitude (default: "54.5")
- `default_lng` - Set default map longitude (default: "-2.5")
- `default_zoom` - Set default map zoom level (default: "6")

### Example with Parameters

```
[coverage_map title="Find Your Local Engineer" subtitle="Coverage across the UK" default_lat="51.5074" default_lng="-0.1278"]
```

## Adding Coverage Points

### Manual Entry

1. Go to Coverage Points in your WordPress admin
2. Click "Add New Coverage Point"
3. Enter the coverage point details:
   - Title (e.g., "DE73")
   - Postal Code (required)
   - Latitude & Longitude (required - can use map picker)
   - Subsidence Claims (optional)
   - Postcode Area (e.g., "DE")
   - Region (e.g., "East Midlands")
   - Contact Name (optional)
   - Contact Phone (optional)
   - Contact Email (optional)
   - Description (optional)
4. Publish the coverage point

### CSV Import

1. Go to Coverage Points > Import CSV
2. Prepare your CSV file with the following columns:
   - ID (optional reference)
   - Title
   - Latitude
   - Longitude
   - Postal Code
   - Subsidence Claims
   - Postcode Area
   - Region
3. Upload the CSV file
4. Choose whether to update existing entries
5. Click "Import CSV"

### CSV Export

1. Go to Coverage Points list
2. Click "Export CSV" button
3. A CSV file will be downloaded with all coverage points

## Image Assets

The plugin includes placeholder images that should be replaced:

1. `/assets/images/coverage.png` - Background image for the coverage section
2. `/assets/images/circle-lines.png` - Decorative circle lines image
3. `/assets/images/search.png` - Search icon (already included from theme)

## Styling

The plugin uses Tailwind CSS with a `cm-` prefix to avoid conflicts with existing styles. All Tailwind classes in the template use this prefix.

Additional custom styles are included in `/assets/css/coverage-map.css`.

## Technical Details

### Post Type
- Post type slug: `coverage_points`
- Supports: title, editor
- Not publicly queryable (only used for data storage)

### Meta Fields
- `_coverage_lat` - Latitude
- `_coverage_lng` - Longitude
- `_coverage_postal_code` - Postal code
- `_coverage_subsidence_claims` - Number of subsidence claims
- `_coverage_postcode_area` - Postcode area (e.g., "DE")
- `_coverage_region` - Region name
- `_coverage_contact_name` - Contact name
- `_coverage_contact_phone` - Contact phone
- `_coverage_contact_email` - Contact email
- `_coverage_description` - Description

### AJAX Endpoint
- Action: `coverage_map_lookup_postcode`
- Nonce: `coverage_map_nonce`
- Returns coverage points within 30 miles of the searched postcode

## Troubleshooting

### Map not displaying
- Ensure Google Maps API key is configured
- Check browser console for JavaScript errors
- Verify API key has proper permissions

### No results found
- Ensure coverage points are published
- Verify coverage points have valid location data
- Check that coverage points are within 30 miles of search location

### Styling issues
- The plugin uses Tailwind CSS with `cm-` prefix
- Check for CSS conflicts with your theme
- Inspect elements to ensure classes are applied correctly

## Support

For issues or feature requests, please contact the plugin developer.