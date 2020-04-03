{%- if theme.post_meta.updated_at.atEnd %}
  {%- set date_diff = date(post.date) != date(post.updated) %}
  {%- if date_diff %}
    <div class="post-end-item">
      <span class="post-end-item-icon">
        <i class="fa fa-calendar-check-o"></i>
      </span>
      <span class="post-end-item-text">{{ __('post.edited') }}</span>
      <time title="{{ __('post.modified') + __('symbol.colon') + full_date(post.updated) }}" itemprop="dateModified" datetime="{{ moment(post.updated).format() }}">{{ date(post.updated) }}</time>
    </div>
  {%- endif %}
{%- endif %}

{%- if config.symbols_count_time.atEnd %}
  <div class="post-end-item" title="{{ __('symbols_count_time.count') }}">
    <span class="post-end-item-icon">
      <i class="fa fa-file-word-o"></i>
    </span>
    {%- if theme.symbols_count_time.item_text_post %}
      <span class="post-end-item-text">{{ __('symbols_count_time.count') + __('symbol.colon') }}</span>
    {%- endif %}
    <span>{{ symbolsCount(post) }}</span>
  </div>
{%- endif %}

{%- if theme.valine.enable and theme.valine.appid and theme.valine.appkey and theme.valine.visitorEnd %}
  <div id="{{ url_for(post.path) }}" class="post-end-item leancloud_visitors" data-flag-title="{{ post.title }}" title="{{ __('post.views') }}">
    <span class="post-end-item-icon">
      <i class="fa fa-eye"></i>
    </span>
    <span class="post-end-item-text">{{ __('post.views') + __('symbol.colon') }}</span>
    <span class="leancloud-visitors-count"></span>
  </div>
{%- endif %}