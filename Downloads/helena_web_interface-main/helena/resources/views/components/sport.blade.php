<div class="mt-8 text-2xl">
    <h3> Salute </h3>
            <div id="sport-container" style="height: 300px;"></div>
            </div>
        </div>
    </div>
  @push('js')
    <script>
      const chartSport = new Chartisan({
        el: '#sport-container',
        url: "@chart('sport')"
      })
      ;
    </script>
    @endpush
    </div>
</div>