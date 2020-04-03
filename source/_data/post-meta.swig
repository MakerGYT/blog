{%- if post.description and (not theme.excerpt_description or not is_index) %}
  <h3 class="post-description-meta {{ post.language }}">{{ __('post.description') }}</h3>
  {%- if post.tags and post.tags.length %}
    <div class="post-keyword">
      <span class="post-keyword-meta {{ post.language }}">{{ __('post.tags') }}</span>
      {%- for tag in post.tags.toArray() %}
        {%- if loop.last %}
          {%- set tag_indicate = '' %}
        {% else %}
          {%- set tag_indicate = __('post.tag_indicate') %}
        {%- endif %}
        <a href="{{ url_for(tag.path) }}" rel="tag">{{ tag.name }}{{ tag_indicate }}</a>
      {%- endfor %}
    </div>
  {%- endif %}
{%- endif %}