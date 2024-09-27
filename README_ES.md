# Webhook
La clase Webhook es una utilidad de PHP destinada para su uso en PocketMine-MP (también puede utilizarse en otras áreas), que permite la entrega de mensajes sin problemas a webhooks de Discord. Te permite crear tanto mensajes simples como embed. Para usarla, simplemente sigue los pasos a continuación.

## Setup
Para configurar Webhook en tu proyecto de PocketMine-MP, sigue estos pasos:
1. **Descargar la versión:** Primero, descarga la última versión de este repositorio. Recibirás un archivo comprimido que contiene todos los archivos necesarios.
2. **Extraer los archivos:** Extrae el contenido de la versión descargada en el directorio `src` de tu proyecto de PocketMine-MP. Se recomienda que la estructura de carpetas esté al mismo nivel que el nombre de tu autor para asegurar una correcta organización. La estructura debería verse así:
   ```scss
   YourPlugin/
      src/
        yourName/
          ...
        webhookpm/
          ...
   ```
3. **Incluir la clase Webhook:** En los archivos de tu proyecto, puedes incluir la clase Webhook utilizando el namespace apropiado:
   ```php
   use webhookpm\kamy\Webhook;
   use webhookpm\kamy\WebhookType;
   ```

## Simple Webhook
Para crear una nueva instancia del webhook, utiliza el método create. Aquí tienes un ejemplo de un webhook simple:
```php
// Crea una nueva instancia del webhook
$webhook = Webhook::create(WebhookType::TYPE_SIMPLE);

// Establece la URL del webhook
$webhook->setUrl('YOUR_WEBHOOK_URL');

// Establece el mensaje a enviar
$webhook->setMessage(['¡Hola mundo!']);

// Envía el mensaje
$webhook->send();
```

### Functions
1. **setUrl(string $url): void**
   - Este método establece la URL del webhook donde se enviarán los mensajes. Debes proporcionar una URL de webhook válida de Discord o un servicio similar.
   - **Ejemplo:**
     ```php
     $webhook->setUrl('YOUR_WEBHOOK_URL');
     ```
2. **setMessage(array $message): void**
   - Este método establece el mensaje que deseas enviar. El mensaje puede ser un arreglo de cadenas, que se concatenarán en un solo mensaje.
   - **Ejemplo:**
     ```php
     $webhook->setMessage(['Hello, this is a line 1 example', 'line 2 example']);
     ```
3. **send(): void**
   - Este método envía el mensaje preparado a la URL de webhook especificada. Construye la carga útil y utiliza cURL para realizar una solicitud POST a la URL del webhook. Si ocurre un error durante la solicitud cURL, registrará el error.
   - **Ejemplo:**
     ```php
     $webhook->send();
     ```

## Embed Webhook
La funcionalidad de Webhook Embed te permite enviar mensajes enriquecidos que incluyen varios campos y opciones de formato. Esto es útil para crear mensajes visualmente atractivos en plataformas como Discord.

Para crear un webhook embed, utiliza el método `create` con el tipo `WebhookType::TYPE_EMBED`. Aquí tienes un ejemplo de cómo usar el webhook embed:
```php
// Crea una nueva instancia del webhook con embeds
$webhook = Webhook::create(WebhookType::TYPE_EMBED);

// Establece la URL del webhook
$webhook->setUrl('YOUR_WEBHOOK_URL');

// Establece los detalles del embed
$webhook->setTitle('Ejemplo de Título del Embed');
$webhook->setDescription(['Esta es la primera línea de la descripción del embed.', 'Esta es la segunda línea.']);
$webhook->setColor('#ff5733'); // Establece el color del embed usando un valor hex
$webhook->setFooter('Texto del Pie', null); // Opcionalmente establece un pie de página

// Agrega campos al embed
$webhook->addField('Campo 1', 'Este es el valor del campo 1.');
$webhook->addField('Campo 2', 'Este es el valor del campo 2.');

// Envía el mensaje embebido
$webhook->send();
```

### Functions
1. **setUrl(string $url): void**
   - Este método establece la URL del webhook donde se enviarán los mensajes. Debes proporcionar una URL de webhook válida de Discord o un servicio similar.
   - **Example:**
     ```php
     $webhook->setUrl('YOUR_WEBHOOK_URL');
     ```
3. **setMessage(array $message): void** `OPCIONAL`
   - Este método establece el mensaje que deseas enviar. El mensaje puede ser un arreglo de cadenas, que se concatenarán en un solo mensaje.
   - **Example:**
     ```php
     $webhook->setMessage(['Hola, este es un ejemplo de línea 1', 'ejemplo de línea 2']);
     ```
4. **setTitle(?string $title): void**
   - Este método establece el título del mensaje embebido. El título aparece como texto en negrita en la parte superior del embed.
   - **Example:**
     ```php
     $webhook->setTitle('Ejemplo de Título del Embed');
     ```
5. **setDescription(array $description): void**
   - Este método establece la descripción del mensaje embebido. Puedes proporcionar un arreglo de cadenas, que se concatenarán en una sola descripción.
   - **Example:**
     ```php
     $webhook->setDescription(['Esta es la primera línea de la descripción del embed.', 'Esta es la segunda línea.']);
     ```
6. **setColor(string $color): void**
   - Este método establece el color del embed. El color debe proporcionarse como un valor hex (por ejemplo, `#ff5733`).
   - **Example:**
     ```php
     $webhook->setColor('#ff5733');
     ```
7. **setFooter(string $footer, ?string $timestamp = null): void**
   - Este método establece el texto del pie de página del embed. Puedes proporcionar opcionalmente un timestamp que se mostrará junto al pie de página.
   - **Example:**
     ```php
     $webhook->setFooter('Texto del Pie');
     ```
8. **addField(string $name, string $value): void**
   - Este método agrega un campo al embed. Cada campo tiene un nombre y un valor, y los campos pueden hacerse `inline` estableciendo inline en verdadero.
   - **Example:**
     ```php
     $webhook->addField('Campo 1', 'Este es el valor del campo 1.');
     ```

# Licencia
Este proyecto está licenciado bajo la Licencia MIT. Consulta el archivo [LICENSE](LICENSE) para más información.
