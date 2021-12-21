<div class="mt-8 text-2xl">
  <h3> Salute </h3>
    <div id="cibo-container" style="height: 300px;"></div>
</div>
</div>
</div>
@push('js')
  <script>
    const chartCibo = new Chartisan({
      el: '#cibo-container',
      url: "@chart('cibo')"
    });
  </script>
  @endpush
  </div>
</div>