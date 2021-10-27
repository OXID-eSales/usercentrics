[{$smarty.block.parent}]

[{if $oViewConf->isSmartDataProtectorActive()}]
    <meta data-privacy-proxy-server="https://privacy-proxy-server.usercentrics.eu">
    <script type="application/javascript" src="https://privacy-proxy.usercentrics.eu/latest/uc-block.bundle.js"></script>

    [{assign var='deactivateBlocking' value=$oViewConf->getSmartDataProtectorDeactivateBlockingServices()}]
    [{if $deactivateBlocking}]
        <script>uc.deactivateBlocking(["[{'", "'|implode:$deactivateBlocking}]"]);</script>
    [{/if}]
[{/if}]

[{if $oViewConf->isDevelopmentAutomaticConsentActive()}]
    <script type="application/javascript">
        console.log('Warning! Development section. Not intended to be used in Live environment!');
        function consentsCheck() {
            if (typeof UC_UI !== 'undefined' && UC_UI.isInitialized()) {
                UC_UI.acceptAllConsents();
                UC_UI.restartCMP();
                document.body.style.overflow='scroll';
                clearInterval(consentsCheckInterval);
            }
        }
        var consentsCheckInterval = setInterval(consentsCheck, 500);
    </script>
[{/if}]