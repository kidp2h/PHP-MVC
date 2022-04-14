<div id="home" class="sectionNav">
  <div class="slider">
    <div class="slider-wrapper">
      <?php
      function SliderItem($slide) {
        if ($slide->id === 1) $active = 'active';
        return '
              <div class="slider-wrapper__slide ' . $active . '">
                  <div class="slide__content">
                      <span>' . $slide->title . '</span>
                      <h3>' . $slide->header . '</h3>
                      <p>' . $slide->desc . '</p>
                      <button class="btn slide__btn">SHOP NOW</button>
                  </div>
                  <div class="slide__imageBox">
                      <img src="" alt="" class="slide__image">
                  </div>
              </div>
          ';
      }

      foreach ($slides as $slide) {
        echo SliderItem($slide);
      }

      ?>
    </div>

    <div class="slider-controls">
      <li class="btn btn-prev"><i class="fas fa-angle-double-left"></i></li>
      <li class="btn btn-next"><i class="fas fa-angle-double-right"></i></li>
    </div>

    <ul class="slider-dots">
      <?php
      function SliderDots($slide) {
        if ($slide->id === 1) $active = 'active';
        return '
            <li class="slider-dot-item ' . $active . '" data-index="' . $slide->id . '"></li>
          ';
      }
      foreach ($slides as $slide) {
        echo SliderDots($slide);
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

      function CategoryItem($category) {
        return '
          <div class="category-item">
            <h2 class="category-content" data-text="' . $category->title . '"> ' . $category->title . ' </h2>
            <div class="category-image__box">
                <img src="" alt="unsplash" class="category-image"/>
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
      <h2 class="heading">Featured Products</h2>
      <p class="content">Select from the premium product and save plenty money</p>
    </div>

    <div class="product-box">
    </div>

    <div class="btn btn-load">Load More</div>
  </div>
</div>