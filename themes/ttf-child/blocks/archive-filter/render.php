 <div class="archive-filter">
        <h2><?php esc_html_e( 'Filter Projects', 'ttfc' ); ?></h2>
        <form id="archive-filter-form" method="GET" action="<?php echo esc_url( home_url( '/projects' ) ); ?>">
            <select name="project_type">
                <option value=""><?php esc_html_e( 'Select Project Type', 'ttfc' ); ?></option>
                <?php
                $terms = get_terms( array(
                    'taxonomy' => 'projects',
                    'hide_empty' => true,
                ) );
                foreach ( $terms as $term ) {
                    echo '<option value="' . esc_attr( $term->slug ) . '">' . esc_html( $term->name ) . '</option>';
                }
                ?>
            </select>
        </form>
        <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('archive-filter-form');
            const select = form.querySelector('select[name="project_type"]');
            select.addEventListener('change', function() {
                const formData = new FormData(form);
                const params = new URLSearchParams(formData).toString();
                fetch(form.action + '?' + params, {
                    headers: { 'X-Requested-With': 'XMLHttpRequest' }
                })
                .then(response => response.text())
                .then(html => {
                    // Replace the result container content
                    const parser = new DOMParser();
                    const doc = parser.parseFromString(html, 'text/html');
                    const newResults = doc.querySelector('.result-container');
                    const currentResults = document.querySelector('.result-container');
                    if (newResults && currentResults) {
                        currentResults.innerHTML = newResults.innerHTML;
                    }
                });
            });
        });
        </script>
    </div>