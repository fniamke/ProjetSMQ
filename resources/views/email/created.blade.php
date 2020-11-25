 <div class="global">
    <table class="cadre" style="font-family: 'Bitstream Vera Sans', Verdana, Tahoma, sans-serif;" cellspacing="0" cellpadding="0">
        <tbody>
            <tr>
                <td style="width: 25%;">
                    <!--
                    <div><img src="http://srv-glpi/glpi/notifications/img/logo.jpg" width="800" height="78" /></div>
                    -->
                </td>
                <td>
                    <div class="titrePrincipal text-right">
                        <!--
                        <div class="action text-center"><br />
                            <h2 style="font-family: 'Bitstream Vera Sans', Verdana, Tahoma, sans-serif; font-size: 14px; font-weight: bold;">AAA</h2>
                        </div>

                        <h2 style="text-align: left; padding-left: 65px; font-family: 'Bitstream Vera Sans', Verdana, Tahoma, sans-serif; font-size: 13px; font-weight: bold;">
                            
                        </h2>

                        -->
                        {{$msg->message}}
                        <a href="{{ route('taches.edit', $msg->IdOrigine . '¤' . 2)}}">Cliquer ici pour voir la tâche</a>
                        <div class="infoPrincipale">Date de création : <strong>{{$msg->created_at}}</strong><br />Demandeur : <strong>{{$msg->emailExpediteur}}</strong></div>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</div>
