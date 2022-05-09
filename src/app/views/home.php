<div id="home" class="sectionNav">
  <div class="slider">
    <div class="slider-wrapper">
      <?php
      function SliderItem($key, $slide)
      {
        if ($key === 0) $active = 'active';
        return '
              <div class="slider-wrapper__slide ' . $active . '">
                  <div class="slide__imageBox">
                      <img src="' . $slide . '" alt="" class="slide__image">
                  </div>
              </div>
          ';
      }

      foreach ($slides as $key => $slide) {
        echo SliderItem($key, $slide);
      }

      ?>
    </div>

    <div class="slider-controls">
      <li class="btn btn-prev"><i class="ion-ios-arrow-back"></i></li>
      <li class="btn btn-next"><i class="ion-ios-arrow-forward"></i></li>
    </div>

    <ul class="slider-dots">
      <?php
      function SliderDots($key)
      {
        if ($key === 0) $active = 'active';
        return '
            <li class="slider-dot-item ' . $active . '" data-index="' . ($key + 1) . '"></li>
          ';
      }
      foreach ($slides as $key => $slide) {
        echo SliderDots($key);
      }
      ?>
    </ul>

  </div>

  <div id="category" class="category sectionNav">
    <div class="category-header">
      <h2 class="heading">Shop Collections</h2>
      <p class="content">Select from the premium product and save plenty money</p>
    </div>

    <div class="category-box">
      <?php

      function CategoryItem($category)
      {
        return '
          <div class="category-item">
            <h2 class="category-content" data-text="' . $category['title'] . '"> ' . $category['title'] . ' </h2>
            <div class="category-image__box">
                <img src="' . $category['image'] . '" alt="unsplash" class="category-image"/>
            </div>
          </div>
          ';
      }

      foreach ($categories as $category) {
        echo CategoryItem($category);
      }
      ?>
    </div>
  </div>

  <div id="feature" class="product  sectionNav">
    <div class="product-header">
      <h2 class="heading">BigSale Products</h2>
      <p class="content">Select from the premium product and save plenty money</p>
    </div>

    <div class="product-box">
    </div>

    <div class="btn btn-load">Load More</div>
  </div>
</div>