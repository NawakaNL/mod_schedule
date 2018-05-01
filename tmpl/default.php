<?php
// No direct access
defined('_JEXEC') or die; ?>

<div class="schedule">
  <div class="schedule-title">
    <i class="fas fa-calendar-alt"></i> Programma <?PHP echo ucfirst($filter); ?>
  </div>
  <div class="schedule-content">
    <ul class="nav">
      <?PHP
      $days_count = 0;
      foreach ($grouped_events as $key=>$value) {
        // Setup date menu
        if (time() < $value[0]->startDate/1000 && $days_count === 0) {
          $days_count++;
          echo "<li class=\"active\" id=\"activekey\">";
        } else if (date("Y-m-d", $value[0]->startDate/1000) == date("Y-m-d")) {
          echo "<li class=\"active\" id=\"activekey\">";
        } else {
          echo "<li>";
        }
         ?>
         <a data-toggle="pill" href="#<?PHP echo $value[0]->startDate; ?>"><?PHP echo $key; ?></a>
       </li>
      <?PHP } ?>
    </ul>

    <div class="tab-content">
      <?PHP
      $make_first_active = True;
      foreach ($grouped_events as $key=>$events) {
        $active = "";
        if ($events[0]->startDate/1000 == date("Y-m-d")) {
          $active = "active";
        } else if ($make_first_active) {
          $make_first_active = False;
          $active = "active";
        }?>
        <div id="<?PHP echo $events[0]->startDate; ?>" class="<?PHP echo $active; ?> tab-pane fade in">
            <ul class="<?php echo $moduleclass_sfx; ?>">
              <?PHP foreach ($events as &$event) {
                // If a filter is defined, filter by subcamp
                if ($filter == "" || strpos($event->tag, $filter) !== false) {

                } else {
                  continue;
                }
                ?>
                <li itemscope itemtype="http://schema.org/Event" class="grid-wrapper">
                  <div class="event-date" itemprop="startDate" content="2013-09-14T21:30">Sat Sep 14</div>
                  <div class="event-date" itemprop="endDate" content="2013-09-14T23:30">Sat Sep 14</div>
                  <div class="event-time"><?PHP echo date('H:i', $event->startDate/1000 - 7200) . '-'. date('H:i', $event->endDate/1000 - 7200); ?></div>
                  <div class="event-description">
                    <div class="event-title" itemprop="name"><?PHP echo $event->title; ?></div>
                    <div class="event-location" itemprop="location"><?PHP echo $event->location; ?></div>
                    <!-- Labels -->
                    <div class="labels">
                      <?PHP
                        // Loop labels
                        foreach(explode(",", $event->tag) as $tag){
                      ?>
                        <span class="label label-<?PHP echo $tag;?>"><?PHP echo $tag;?></span>
                      <?PHP } ?>
                    </div>
                  </div>
                  <div class="clearfix"></div>
          			</li>
              <?PHP } ?>
            </ul>
        </div>
      <?PHP } ?>
    </div>
    <script>
    // Scroll to active element
    $('ul.nav').animate({scrollLeft: $('li.active').position().left - 20}, 500);
    </script>
  </div>
</div>
