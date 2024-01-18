# WordPress Custom Post Types Blueprint 

**Easily create custom post types in WordPress with this handy blueprint.**

## Description

This project provides a starter code snippet to help you quickly set up custom post types in WordPress. It's perfect for organizing content beyond the default posts and pages, empowering you to create specialized content structures for:

- FAQs
- Portfolio items
- Team members
- Testimonials
- Products
- Events
- ...and much more!

## Installation

1. **Access your theme's functions.php file:**
    - Navigate to Appearance > Theme Editor in your WordPress dashboard.
    - Select the functions.php file from the list on the right.

2. **Paste the blueprint code:**
    - Copy the code from the `chrs-post-types.php` file in this repository.
    - Paste it at the end of your theme's functions.php file.

3. **Customize the code (optional):**
    - Refer to the WordPress Codex for detailed customization options: https://codex.wordpress.org/Post_Types

## Usage

1. **Customize Constants:**
    - Edit the plugin file and modify the following constants to match your preferences:
    - CHRS_CPT_TEXT_DOMAIN: The text domain for translations (if needed).
    - CHRS_CPT_LABEL_SINGLE: The singular label for the post type (e.g., "Location").
    - CHRS_CPT_LABEL_PLURAL: The plural label for the post type (e.g., "Locations").
    - CHRS_CPT_SINGLE_SLUG: The slug used for individual location posts.
    - CHRS_CPT_ARCHIVE_SLUG: The slug used for the archive page of locations.

2. **Save the changes:**
    - Click the "Update File" button in the Theme Editor.

## Accessing Your Custom Post Type

- Your custom post type will now appear in the WordPress admin menu.
- Create, edit, and manage posts within your new custom post type just like regular posts and pages!

## Additional Notes

- **Advanced Customization:** Explore the WordPress Codex for more in-depth options and features to tailor your custom post types to your exact needs.

## Contributing

We welcome contributions to improve this blueprint! Feel free to submit pull requests or open issues for suggestions and feedback.

## License

This project is licensed under the MIT License. See the LICENSE file for details.

**Happy content structuring!**
