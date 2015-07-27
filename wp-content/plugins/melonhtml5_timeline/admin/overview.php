<div class="timeline-container">
    <h2>MelonHTML5 - Timeline</h2>
    <div class="timeline-list-title">Overall Settings:</div>
    <div class="timeline-list">
        <span>Theme:</span>&nbsp;
        <select name="theme">
            <option value="default">Default</option>
            <option value="light">Light</option>
            <option value="dark">Dark</option>
            <option value="white">White</option>
            <option value="simple">Simple</option>
        </select>
        <span id="theme-save-success">Theme Saved!</span>
    </div>
    <br>
    <div class="timeline-list-title">Timeline List</div>
    <div class="timeline-list">
        <table class="timeline-list" cellspacing="0" cellpadding="10">
            <thead>
                <tr>
                    <th></th>
                    <th>Name</th>
                    <th>Animation</th>
                    <th>Lightbox</th>
                    <th>Date Format</th>
                    <th>Separator</th>
                    <th>Column Mode</th>
                    <th>Order</th>
                    <th>Max</th>
                    <th>Loadmore</th>
                    <th>Responsive Width</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
    <br>
    <input type="button" class="button button-primary" id="timeline-add-button" value="Add New" />
    <input type="button" class="button" id="timeline-delete-button" value="Delete" />
    <input type="button" class="button" id="timeline-copy-button" value="Copy" />
</div>
<script>
    var blog_categories = {
<?php
    $categories = array();
    foreach (get_categories() as $category) {
        $categories[] = '        ' . $category->cat_ID . ': "' . addcslashes($category->name, '\"') . '"';
    }

    print implode(",\r\n", $categories);
?>

    };
</script>
