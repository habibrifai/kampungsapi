<html>
  <body>

<!-- TODO: Remove ".sandbox" from script src URL for production environment. Also input your client key in "data-client-key" -->
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="VT-client-m5uTN4akyxLJZ2xK"></script>
    <script type="text/javascript">
    //   document.getElementById('pay-button').onclick = function(){
        // SnapToken acquired from previous step
        snap.pay('<?=$snapToken?>', {
          onSuccess: function(result){
            // document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
            window.location = '<?=base_url()?>'
          },
          onPending: function(result){
            window.location = '<?=base_url()?>'
            // document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
          },
          onError: function(result){
            window.location = '<?=base_url()?>'
            // document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
          }
        });
    //   };
    </script>
  </body>
</html>
