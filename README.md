
# D&R CASE

Bu proje iş görüşmesi sonucunda talep edilen case projesi için yapılmıştır. Olabildiğince mimari ye ve clean code'a önem vermeye çalıştım. Eksikler ve hatalar için issue açabilir benimle bu projeyi geliştirmemde yardımcı olabilirsiniz. 




## Kullanılan Teknolojiler



 PHP, RABBİTMQ, REDİS, LARAVEL, DOCKER, MYSQL, NGİNX

  
## Rozetler

[![MIT License](https://img.shields.io/badge/License-MIT-green.svg)](https://choosealicense.com/licenses/mit/)

[![GPLv3 License](https://img.shields.io/badge/php-8.0.3-blue)](https://opensource.org/licenses/)

[![AGPL License](https://img.shields.io/badge/laravel-9.41-red)](http://www.gnu.org/licenses/agpl-3.0)

  
## Kurulum & Dağıtım

Öncelikle local bilgisayarınıza projeyi clone edin.

```bash
  git clone https://github.com/brylmaz/drcase.git

```
Bilgisayarınızda Docker Desktop yüklü olmalıdır
daha sonra src/docker-compose.yml yolunda docker compose dosyası bulunmaktadır. src klasörünün içindeyken komut satırı açın ve aşşağıdaki kodu yazın

```bash
  docker compose up

  veya

  docker compose up --build
  
```

Proje ayağa kalktıktan sonra sırasıyla aşağıdaki kodları docker da çalışan main container cli na yazın.

```bash
  composer install
  
  php artisan migrate    // Veritabanı tabloları oluşturmak için
  
  php artisan db:seed   // Tabloları veriler ile doldurmak için
  
```

Bu projede rabbitmq kullanıyorum. çok araştırmama rağmen kuyruğu otomatik çalıştırmadım. Bu yüzden manuel kuyruğu çalıştırmamız gerekecek.

```bash
  php artisan queue:work --queue=createOrder   
  
```

Projemiz hazır !
## Postman Collections

Api Kullanımına geçmeden önce hazır postman collection ile isteklerde bulunabilirsiniz.

Postman : https://api.postman.com/collections/9693476-17dbfee3-2cb9-463d-a25a-e44be1ba39fe?access_key=PMAT-01GVN3K5MW9QWT8CAR8NTNZ69S

Bu linki postman de import butonuna tıklayıp link sekmesine yapıştırıp dahil ediniz.

  
## API Kullanımı

### Sipariş Oluştur (CreateOrder)

Burada sipariş oluşturabiliyoruz. Gönderdiğiniz ürünlerden herhangibiri stok durumu yetersiz se sipariş oluşturulmaz. Sipariş oluşturulma başarılı olursa O ürünlerin stok larından düşecektir.

#### Endpoint
```http
  POST http://localhost:8080/api/v1/CreateOrder
```

| Parametre | Tip     | Açıklama                |
| :-------- | :------- | :------------------------- |
| `product_id` | `number` | **Gerekli**. Ürün id si |
| `piece` | `number` | **Gerekli**. Adet. |

#### Request Example

```http
  [
    {
        "product_id":11,
        "piece" : 2
    },
    {
        "product_id":12,
        "piece" : 2
    },
        {
        "product_id":8,
        "piece" : 10
    }
  ]
```

#### Response Example

  Sipariş numarasını getOrder api sinde kullanıp sipariş bilgilerini görüntüleyebilirsiniz.
```http
{
    "success": "TRUE",
    "Sipariş Numarası": 1333415935,
    "message": "Siparişiniz işleme alınmıştır."
}
```



#### Endpoint
```http
  POST http://localhost:8080/api/v1/GetOrder
```

### Sipariş Sorgulama (GetOrder)
Siparişinizle ilgili kampanya bilgileri ödeme tutarı satın alınan ürünler gösterilir.
| Parametre | Tip     | Açıklama                |
| :-------- | :------- | :------------------------- |
| `OrderNumber` | `number` | **Gerekli**. Sorgulanacak Sipariş Numarası |

#### Request Example

```http
[
    {
        "OrderNumber":2022063275
    }
]
```

#### Response Example

  
```http
  {
    "success": "TRUE",
    "message": " Sipariş Bilgileri Listelenmiştir.",
    "data": [
        {
            "order_number": 2022063275,
            "total_price": "40.30",
            "discount_amount": "10.40",
            "amount_to_be_paid": "29.90",
            "campain_info": "Sabahattin Ali'nin Romanlarında İndirim",
            "created_at": "2023-03-15T12:33:38.000000Z",
            "order_line": [
                {
                    "product_id": 11,
                    "price": 10.4,
                    "piece": 2,
                    "product": {
                        "title": "Kuyucaklı Yusuf",
                        "list_price": "10.40",
                        "stock_quantity": -2,
                        "CategoryName": "Roman",
                        "AuthorName": "Sabahattin Ali",
                        "AuthorType": "Yerli"
                    }
                },
                {
                    "product_id": 12,
                    "price": 9.75,
                    "piece": 2,
                    "product": {
                        "title": "Kamyon - Seçme Öyküler",
                        "list_price": "9.75",
                        "stock_quantity": 5,
                        "CategoryName": "Öykü",
                        "AuthorName": "Sabahattin Ali",
                        "AuthorType": "Yerli"
                    }
                }
            ]
        }
    ]
}
```

### Kampanya Listeleme (ListCampaign)
  Tüm kampanyaları buradan görüntüleyebilirsiniz.
  #### Endpoint
```http
  GET http://localhost:8080/api/v1/ListCampaign
```

Bu istekte bir değer göndermeyiniz.

#### Response Example

```http
{
    "success": "TRUE",
    "message": "Listeleme Başarılı",
    "data": [
        {
            "name": "Sabahattin Ali'nin Romanlarında İndirim 2 Alana Bir Bedava",
            "type": "SpecificAuthorCampaign",
            "rule": "{\"author_id\": 3, \"order_product_quantity\": 2}",
            "discount": 1
        },
        {
            "name": "Yerli Yazar Kitaplarında %5 indirim",
            "type": "DomesticAuthorCampaign",
            "rule": "{\"authorType\": \"Yerli\"}",
            "discount": 5
        },
        {
            "name": "200 TL ve üzeri alışverişlerde sipariş toplamına %5 indirim",
            "type": "TotalPriceCampaign",
            "rule": "{\"total_price\": 200}",
            "discount": 5
        }
    ]
}
```

### Kampanya Düzenleme (EditCampaign)
  Kampanyaları buradan düzenleyebilirsiniz. Burada örneğin SpecificAuthorCampaign için konuşacak olursak; author_id değerini (ListAuthor ile tüm yazarları çekebilirsiniz) değiştirerek sadece sabahattin ali nin kitapları indirimli değil bir başka yazarın kitap kampanyası uygulanabilir. Örneğin order_product_quantity değerini 4 yaparsak artık o yazarın 4 adet kitabını alanın discount değeri kadar kitabı bedava alabilir.

  Burada dinamik olarak kampanyaları değiştirebiliriz.

  #### Endpoint
```http
  PUT http://localhost:8080/api/v1/EditCampaign
```
| Parametre | Tip     | Açıklama                |
| :-------- | :------- | :------------------------- |
| `SpecificAuthorCampaign` | `json` | **Gerekli**. Belirli yazarda bedava kitap kampanyası |
| `DomesticAuthorCampaign` | `json` | **Gerekli**. Yerli&Yabancı yazar kitaplarında indirim|
| `TotalPriceCampaign` | `json` | **Gerekli**. Toplam fiyat indirimi kampanyası|
| `rule` | `json` | **Gerekli**. Kuralllar|
| `author_id` | `number` | **Gerekli**. Yazar id si|
| `order_product_quantity` | `number` | **Gerekli**. Kaç adet üründen sonra kampanya uygulanacak onun değeri|
| `name` | `string` | **Gerekli**. Kampanya isimleri|
| `discount` | `number` | **Gerekli**. Kurallar doğruysa uygulanacak indirim yüzde veya adet değeri|
| `authorType` | `Enum` | **Gerekli**. Sadece Yerli ve Yabancı değeri yazılabilir|
| `total_price` | `number` | **Gerekli**. Toplam Fiyat kuralı|

#### Request Example

```http
{
    "SpecificAuthorCampaign": {    
        "rule" : {
            "author_id": 3,
            "order_product_quantity": 2
        },
        "name": "Sabahattin Ali'nin Romanlarında İndirim 2 Alana Bir Bedava",
        "discount": 1
    },
    "DomesticAuthorCampaign": {
        "rule" : {
            "authorType": "Yerli"
        },
        "name": "Yerli Yazar Kitaplarında %5 indirim",
        "discount": 5
    },
    "TotalPriceCampaign": {
        "rule" : {
            "total_price": 200
        },
        "name": "200 TL ve üzeri alışverişlerde sipariş toplamına %5 indirim",
        "discount": 5
    }
}

```

#### Response Example

```http
{
    "success": "TRUE",
    "message": "Güncelleme Başarılı."
}

```

### Yazar Listeleme (ListAuthor)
  Tüm Yazarları buradan görüntüleyebilirsiniz.
  #### Endpoint
```http
  GET http://localhost:8080/api/v1/ListAuthor
```

Bu istekte bir değer göndermeyiniz.

#### Response Example

```http

{
    "success": "TRUE",
    "message": "Listeleme Başarılı",
    "data": [
        {
            "id": 1,
            "name": "Yaşar Kemal",
            "type": "Yerli"
        },
        {
            "id": 2,
            "name": "Oğuz Atay",
            "type": "Yerli"
        },
        {
            "id": 3,
            "name": "Sabahattin Ali",
            "type": "Yerli"
        },
        {
            "id": 4,
            "name": "John Steinback",
            "type": "Yabancı"
        },
        {
            "id": 5,
            "name": "Jose Mauro De Vasconcelos",
            "type": "Yabancı"
        },
        {
            "id": 6,
            "name": "Hakan Mengüç",
            "type": "Yerli"
        },
        {
            "id": 7,
            "name": "Stephen Hawking",
            "type": "Yabancı"
        },
        {
            "id": 8,
            "name": "Uğur Koşar",
            "type": "Yerli"
        },
        {
            "id": 9,
            "name": "Mehmet Yıldız",
            "type": "Yerli"
        },
        {
            "id": 10,
            "name": "Mert Arık",
            "type": "Yerli"
        },
        {
            "id": 11,
            "name": "Marcus Aurelius",
            "type": "Yabancı"
        },
        {
            "id": 12,
            "name": "Michel de Montaigne",
            "type": "Yabancı"
        },
        {
            "id": 13,
            "name": "George Orwell",
            "type": "Yabancı"
        },
        {
            "id": 14,
            "name": "Peyami Safa",
            "type": "Yerli"
        }
    ]
}

```

