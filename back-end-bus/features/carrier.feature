Feature: Crear transportista y persona asociada

  Scenario: Creación exitosa de un transportista y persona asociada
    When envío una solicitud POST a "/api/transportistas" con los datos requeridos
    Then debería recibir una respuesta con estado 201
    And debería ver un mensaje de éxito de creación
    And la respuesta debe incluir los detalles del transportista creado
