# Content Snippets - WordPress Plugin

![WordPress Tested](https://img.shields.io/badge/wordpress-4.5.3%20tested-brightgreen.svg)

A WordPress plugin for creating and displaying content snippets via a [custom post type](https://codex.wordpress.org/Post_Types#Custom_Post_Types). The plugin allows for editing of sections of a webpage, without providing full access to the template.

![Screenshot of plugin.](https://corenominal.org/wp-content/uploads/2016/04/Content_Snippets__WordPress_Plugin.png)

Content snippets can be embedded into templates and pages via the provided function. E.g.

    <?php iewp_content_snippet( 13 ) ?>

Where '13' is the ID of the content snippet, or

	<?php iewp_content_snippet( 'Front Page - FAQs' ) ?>

Where 'Front Page - FAQs' is the title of the content snippet.
