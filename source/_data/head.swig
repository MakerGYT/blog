{% set content = config.keywords %}
{%- if site.tags and site.tags.length %}
  {%- for tag in site.tags.toArray() %}
    {% set content = content + ',' + tag.name %}
  {%- endfor %}
{%- endif %}
<meta name="keywords" content="{{ content }}">