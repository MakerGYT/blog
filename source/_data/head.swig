{% set content = config.keywords %}
{%- if site.tags and site.tags.length %}
  {%- for tag in site.tags.toArray() %}
    {% set content = content + ',' + tag.name %}
  {%- endfor %}
{%- endif %}
<meta name="keywords" content="{{ content }}">
{%- if config.grayscale%}
<style> 
  html { 
      -webkit-filter: grayscale(100%); 
      -moz-filter: grayscale(100%); 
      -ms-filter: grayscale(100%); 
      -o-filter: grayscale(100%); 
      filter:progid:DXImageTransform.Microsoft.BasicImage(grayscale=1);  
      _filter:none; 
  } 
</style> 
{%- endif %}