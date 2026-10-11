# Güzellik Koaför

Kadın kuaförleri ve güzellik salonları için hazırlanmış, mobil uyumlu Bludit teması. WhatsApp üzerinden randevu bağlantısı ile kampanya ve blog içerikleri için ayrı ana sayfa bölümleri sunar.

## Kurulum

`bl-themes/guzellik-koafor` klasörünü Bludit kurulumunuzun `bl-themes` klasörüne kopyalayın ve yönetim panelinden **Güzellik Koaför** temasını etkinleştirin.

## WhatsApp ve sosyal medya

WhatsApp numarası, Instagram ve Facebook adresleri temanın `index.php` dosyasının başında tanımlanır:

- `$whatsappNumber`: ülke koduyla birlikte, yalnızca rakamlar (ör. `905551112233`)
- `$instagramUrl`: Instagram profil bağlantısı; boş bırakılırsa gösterilmez
- `$facebookUrl`: Facebook sayfa bağlantısı; boş bırakılırsa gösterilmez

Randevu bağlantısı, ayarlanan numaraya önceden yazılmış randevu mesajıyla yönlendirir. Numara boş bırakılırsa WhatsApp uygulaması/sohbet seçimi açılır.

## Kampanyalar ve blog

Bludit içeriklerinizi `Kampanyalar` veya `Blog` kategorilerine atayın. Tema, kategori anahtarları `kampanya`, `kampanyalar`, `campaign`, `campaigns` olan içerikleri **Kampanyalar** bölümünde; `blog`, `yazilar` veya `yazılar` olan içerikleri **Blog** bölümünde gösterir. Her bölüm en fazla üç içeriği listeler. Diğer sayfalar ve kategori arşivleri de kendi standart içerik görünümünde açılır.
